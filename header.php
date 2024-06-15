<?php
include 'config.php';

session_start();
if (!isset($_SESSION['state'])) {
    $_SESSION['state'] = "guest";
}

echo '<header class="bg-slate-800 shadow-md text-white flex justify-between px-48 py-8">';

echo '<h1 class="text-2xl font-bold"><a href="' . SITE_URL . 'index.php" class="hover:text-gray-300">Haber Sitesi</a></h1>';
echo '<nav>';
echo '    <ul class="flex space-x-4">';
echo '        <li><a href="' . SITE_URL . 'havadurumu/havadurumu.php" class="hover:text-gray-300">Hava Durumu</a></li>';
echo '        <li><a href="' . SITE_URL . 'hakkimizda/hakkimizda.php" class="hover:text-gray-300">Hakkımızda</a></li>';
echo '        <li><a href="' . SITE_URL . 'iletisim/iletisim.php" class="hover:text-gray-300">İletişim</a></li>';
if ($_SESSION['state'] == "uye") {
    echo '        <li><a href="cikis.php" class="hover:text-gray-300">Çıkış Yap</a></li>';
} else if ($_SESSION['state'] == "admin") {
    echo '        <li><a href="' . SITE_URL . 'admin/admin.php" class="hover:text-gray-300">Admin Paneli</a></li>';
    echo '        <li><a href="' . SITE_URL . 'yazar/yazar.php" class="hover:text-gray-300">Yazar Paneli</a></li>';
    echo '        <li><a href="' . SITE_URL . 'cikis.php" class="hover:text-gray-300">Çıkış Yap</a></li>';
} else if ($_SESSION['state'] == "yazar") {
    echo '        <li><a href="' . SITE_URL . 'yazar/yazar.php" class="hover:text-gray-300">Yazar Paneli</a></li>';
    echo '        <li><a href="' . SITE_URL . 'cikis.php" class="hover:text-gray-300">Çıkış Yap</a></li>';
} else {
    echo '        <li><a href="' . SITE_URL . 'giris.php" class="hover:text-gray-300">Giriş Yap</a></li>';
    echo '        <li><a href="' . SITE_URL . 'kayit.php" class="hover:text-gray-300">Kayıt Ol</a></li>';
}
echo '    </ul>';
echo '</nav>';

echo '</header>';
?>