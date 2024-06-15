<?php
include("baglanti.php");
$username = mysqli_real_escape_string($baglanti, $_POST['username']);
$email = mysqli_real_escape_string($baglanti, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

if($username == "" || $email == "" || $password == "") {
    echo '
    <script>
    alert("Kayıt yapabilmek için tüm gerekli alanları doldurunuz.");
    window.location.href = "kayit.php";
    </script>';
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '
    <script>
    alert("Girilen e-posta adresi geçersizdir.");
    window.location.href = "kayit.php";
    </script>';
    exit();
} else {
    try {
        $query = "INSERT INTO `kullanicilar`(`kullaniciAdi`, `mail`, `password`, `accountState`) VALUES ('$username', '$email', '$password', 'uye')";
        if (mysqli_query($baglanti, $query)) {
            echo '
            <script>
            alert("Kayıt başarılı, giriş sayfasına yönlendiriliyorsunuz...");
            window.location.href = "giris.php";
            </script>';
            exit();
        }
      }
      catch(Exception $e) {
        if (mysqli_errno($baglanti) == 1062) {
            echo '
            <script>
            alert("Kullanıcı adı veya e-posta zaten kullanılıyor.");
            window.location.href = "kayit.php";
            </script>';
            exit();
        } else {
            echo '
            <script>
            alert("Bir hata oluştu: ' . $e . '");
            window.location.href = "kayit.php";
            </script>';
            exit();
        }
      }

    mysqli_close($baglanti);
}



?>