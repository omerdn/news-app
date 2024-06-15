<?php
$db_sunucu="localhost";
$db_kullanici="root";
$db_sifre="";
$db_adi="haberlertest";

$baglanti=mysqli_connect($db_sunucu,$db_kullanici,$db_sifre,$db_adi);
mysqli_set_charset($baglanti, "utf8");
if(!$baglanti){
    die("Veritabanına bağlanılamadı!".mysqli_connect_error());
}
?>