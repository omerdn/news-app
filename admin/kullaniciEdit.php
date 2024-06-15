<?php
include("../baglanti.php");

$id=$_POST["formID"];
$isim=mysqli_real_escape_string($baglanti, $_POST["formIsim"]);
$email=mysqli_real_escape_string($baglanti, $_POST["formEmail"]);
$state=mysqli_real_escape_string($baglanti, $_POST["formState"]);

$guncelle = "UPDATE `kullanicilar` SET `kullaniciAdi`='$isim', `mail`='$email', `accountState`='$state' WHERE `kullaniciID`=$id";

if($baglanti->query($guncelle)===true){
    echo "<script type='text/javascript'>";
    echo "alert('Kullanıcı Güncellendi.');";
    echo "window.location = 'kullanicilar.php';";
    echo "</script>";
}

else{
echo "Hata Oluştu!";
}

?>