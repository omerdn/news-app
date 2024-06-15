<?php
include("../baglanti.php");
$id=$_POST["formID"];
$baslik = mysqli_real_escape_string($baglanti, $_POST["haberBaslik"]);
$icerik = mysqli_real_escape_string($baglanti, $_POST["haberIcerik"]);
$foto = mysqli_real_escape_string($baglanti, $_POST["haberResim"]);
$kategori = mysqli_real_escape_string($baglanti, $_POST["formKategori"]);

$guncelle = "UPDATE `haberler` SET `title`='$baslik',`content`='$icerik',`image_url`='$foto', kategori='$kategori' WHERE id=".$id;

if($baglanti->query($guncelle)===true){
    echo "<script type='text/javascript'>";
    echo "alert('Haber Güncellendi.');";
    echo "window.location = 'adminHaberler.php';";
    echo "</script>";
}

else{
echo "Hata Oluştu!";
}

?>