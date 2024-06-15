<?php
include("baglanti.php");
session_start();
$icerik = mysqli_real_escape_string($baglanti, $_POST['yorum_icerik']);
$isim = mysqli_real_escape_string($baglanti, $_POST['yorum_isim']);
$id = $_POST['formID'];

$ekle = "INSERT INTO `yorumlar` (`yorum_author`, `yorum_content`, `haber_id`, `onaylı`, `yorum_tarih`) VALUES ('$isim', '$icerik', $id, 'bekleyen', CURDATE())";

if ($_SESSION['state'] == 'guest') {
    $kullaniciKontrol = mysqli_query($baglanti, "SELECT kullaniciAdi FROM `kullanicilar` WHERE kullaniciAdi = '" . $isim . "'");
    if (mysqli_num_rows($kullaniciKontrol) > 0) {
        echo "<script type='text/javascript'>";
        echo "alert('Belirtilen rumuz kayıtlı kullanıcı bulunmaktadır, giriş yapınız veya başka bir rumuz seçiniz....');";
        echo "window.location = 'haber.php?id=" . $id . "';";
        echo "</script>";
        exit();
    }
}


if ($baglanti->query($ekle) === true) {
    echo "<script type='text/javascript'>";
    echo "alert('Mesajınız gönderildi, yönetici tarafından onaylandıktan sonra görüntülenecektir...');";
    echo "window.location = 'haber.php?id=" . $id . "';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('Hata: " . mysqli_error($baglanti) . "');";
    echo "window.location = 'haber.php?id=" . $id . "';";
    echo "</script>";
}
?>
