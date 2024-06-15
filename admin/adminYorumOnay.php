<?php
include("../baglanti.php");

$yorum_id=$_POST["yorum_id"];

$guncelle = "UPDATE `yorumlar` SET `onaylı`= 'onaylanan' WHERE `yorum_id`=" . $yorum_id;



if($baglanti->query($guncelle)===true){
    echo "<script type='text/javascript'>";
    echo "window.location = 'yorumlar.php';";
    echo "</script>";
}

else{
echo "Hata Oluştu!";
}
?>