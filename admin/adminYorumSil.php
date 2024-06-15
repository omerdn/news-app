<?php
include("../baglanti.php");

$yorum_id=$_POST["yorum_id"];

$sil="DELETE FROM yorumlar WHERE yorum_id='$yorum_id'";


if($baglanti->query($sil)===true){
    echo "<script type='text/javascript'>";
    echo "window.location = 'yorumlar.php';";
    echo "</script>";
}

else{
echo "Hata Oluştu!";
}

?>