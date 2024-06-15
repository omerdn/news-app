<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    include("baglanti.php");

    
    $query = $baglanti->prepare("SELECT * FROM kullanicilar WHERE kullaniciAdi = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['kullaniciAdi'] = $user["kullaniciAdi"];
            $_SESSION['userID'] = $user["kullaniciID"];
            $_SESSION['state'] = $user["accountState"];
            echo '<script>
                    alert("Giriş başarılı, hoş geldiniz!");
                    window.location.href = "index.php";
                  </script>';
            exit();
        } else {
            echo '<script>
                    alert("Geçersiz kullanıcı adı veya şifre.");
                    window.location.href = "giris.php";
                  </script>';
            exit();
        }
    } else {
        echo '<script>
                alert("Geçersiz kullanıcı adı veya şifre.");
                window.location.href = "giris.php";
              </script>';
        exit();
    }

    $query->close();
    $baglanti->close();
}
?>
