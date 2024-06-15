<?php
session_start();
include("../baglanti.php");

$baslik = mysqli_real_escape_string($baglanti, $_POST["title"]);
$icerik = mysqli_real_escape_string($baglanti, $_POST["content"]);
$resimlink = mysqli_real_escape_string($baglanti, $_POST["image"]);
$kategori = mysqli_real_escape_string($baglanti, $_POST["formKategori"]);

$ekle = "INSERT INTO haberler (title, content, image_url, publish_date, author, kategori) VALUES ('$baslik', '$icerik', '$resimlink', CURDATE(), '".$_SESSION['kullaniciAdi']."', '$kategori')";

if ($baglanti->query($ekle) === TRUE) {
    echo "<script type='text/javascript'>";
    echo "alert('Haber Eklendi.');";
    echo "window.location = 'yazar.php';"; 
    echo "</script>";
} else {
    echo "Hata Oluştu: " . $baglanti->error;
}
?>
