<?php
include("../baglanti.php");

$isim=mysqli_real_escape_string($baglanti, $_POST["ad"]);
$telefon=mysqli_real_escape_string($baglanti, $_POST["telefon"]);
$email=mysqli_real_escape_string($baglanti, $_POST["email"]);
$konu=mysqli_real_escape_string($baglanti, $_POST["konu"]);
$mesaj=mysqli_real_escape_string($baglanti, $_POST["mesaj"]);

if($isim == "" || $telefon == "" || $email == "" || $konu == "" || $mesaj == "") {
    echo '
    <script>
    alert("Mesaj gönderebilmek için tüm alanları doldurunuz.");
    window.location.href = "iletisim.php";
    </script>';
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '
    <script>
    alert("Geçersiz e-posta adresi.");
    window.location.href = "iletisim.php";
    </script>';
    exit();
}

if (!preg_match('/^\d+$/', $telefon)) { //regular expression
    echo '
    <script>
    alert("Telefon alanı sadece rakamlardan oluşmalıdır.");
    window.location.href = "iletisim.php";
    </script>';
    exit();
}

$ekle="INSERT INTO `mesajlar`(`isim`, `telefon`, `email`, `konu`, `mesaj`) VALUES ('".$isim."','".$telefon."','".$email."','".$konu."','".$mesaj."')";


if($baglanti->query($ekle)===true){
    echo "<script type='text/javascript'>";
    echo "alert('Mesajınız başarıyla gönderildi.');";
    echo "window.location = '../index.php';"; 
    echo "</script>";
}

else{
    echo"Hata oluştu!";
}
?>
