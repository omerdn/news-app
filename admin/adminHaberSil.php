<?php
include("../baglanti.php");

$haber_id=$_POST["haber_id"];

$sil="DELETE FROM haberler WHERE id='$haber_id'";


if($baglanti->query($sil)===true){
    echo "<script type='text/javascript'>";
    echo "alert('Haber Silindi.');";
    echo "window.location = 'adminHaberler.php';";
    echo "</script>";
}

else{
echo "Hata Oluştu!";
}

?>