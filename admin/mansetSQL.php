<?php
include("../baglanti.php");

// POST verilerini işlemek için tam sayı dönüştürme
$dizi = array(
    intval($_POST["idgiris1"]),
    intval($_POST["idgiris2"]),
    intval($_POST["idgiris3"]),
    intval($_POST["idgiris4"]),
    intval($_POST["idgiris5"])
);

$sonuc = true; // Başlangıçta başarı durumu

for ($i = 0; $i < 5; $i++) {
    $mansetId = $i + 1; // mansetId 1'den başlıyor
    $haberID = $dizi[$i];

    $query = "UPDATE `manset` SET `haberID` = $haberID WHERE `mansetId` = $mansetId";
    $result = mysqli_query($baglanti, $query);

    if (!$result) {
        $sonuc = false; // Eğer herhangi bir sorgu başarısız olursa, sonuç false olur
        break;
    }
}

if ($sonuc) {
    echo '<script>alert("Kayıt başarıyla güncellendi"); window.location.href = "admin.php";</script>';
} else {
    echo '<script>alert("Kayıt güncellenirken hata oluştu"); window.location.href = "admin.php";</script>';
}
?>

