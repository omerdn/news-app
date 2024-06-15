<?php
include("../baglanti.php");

$kullanici_ID=$_POST["kullanici_id"];

$sil="DELETE FROM kullanicilar WHERE kullaniciID='$kullanici_ID'";


if($baglanti->query($sil)===true){
    echo "<script type='text/javascript'>";
    echo "alert('Kullanıcı Silindi.');";
    echo "window.location = 'kullanicilar.php';";
    echo "</script>";
}

else{
echo "Hata Oluştu!";
}

?>