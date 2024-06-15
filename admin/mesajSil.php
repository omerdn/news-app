<?php
include("../baglanti.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['mesaj_id'])) {
        $mesaj_id = intval($_POST['mesaj_id']);
        $silmeSorgusu = "DELETE FROM mesajlar WHERE mesaj_id = $mesaj_id";
        
        if (mysqli_query($baglanti, $silmeSorgusu)) {
            echo '<script>alert("Mesaj başarıyla silindi."); window.location.href = "mesajlar.php";</script>';
        } else {
            echo '<script>alert("Mesaj silinirken bir hata oluştu."); window.location.href = "mesajlar.php";</script>';
        }
    }
}
?>