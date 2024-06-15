<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php if ($_SESSION['state'] == "admin" || $_SESSION['state'] == "yazar") : ?>

    <body class="bg-amber-50 min-h-screen flex flex-col">
        <?php include("yazarHeader.php"); ?>
        <div class="w-5/6 mx-auto bg-slate-50 flex-grow flex">
            <main class="p-8 w-full">
                <div class="w-1/2 mx-auto bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-6 text-center">Haber Ekle</h2>
                    <?php
                    include("../baglanti.php");

                    echo '<form action="haberEkleSQL.php" method="post" class="space-y-4">';
                    echo '    <div>';
                    echo '        <label for="title" class="block text-gray-700 font-bold mb-2">Başlık</label>';
                    echo '        <input type="text" id="title" name="title" required class="w-full p-3 border border-gray-300 rounded" placeholder="Başlık Giriniz :">';
                    echo '    </div>';
                    echo '    <div>';
                    echo '        <label for="image" class="block text-gray-700 font-bold mb-2">Resim URL</label>';
                    echo '        <input type="text" id="image" name="image" required class="w-full p-3 border border-gray-300 rounded" placeholder="Resim URL Giriniz:">';
                    echo '    </div>';
                    echo '    <div>';
                    echo '        <label for="formKategori" class="block text-gray-700 font-bold mb-2">Kategori</label>';
                    echo '        <select name="formKategori" id="hKategori" class="mb-4 block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">';
                    $kategoriler = mysqli_query($baglanti, "SELECT kategori_adi FROM kategoriler");
                    while ($ksatir = mysqli_fetch_array($kategoriler)) {
                        echo '            <option value="' . $ksatir['kategori_adi'] . '">' . $ksatir['kategori_adi'] . '</option>';
                    }
                    echo '        </select>';
                    echo '    </div>';
                    echo '    <div>';
                    echo '        <label for="content" class="block text-gray-700 font-bold mb-2">İçerik</label>';
                    echo '        <textarea name="content" required class="w-full p-2 border border-gray-300 rounded h-40" placeholder="İçerik Giriniz:"></textarea>';
                    echo '    </div>';
                    echo '    <div class="flex justify-end">';
                    echo '        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Ekle</button>';
                    echo '    </div>';
                    echo '</form>';
                    ?>
                </div>
            </main>
        </div>

    <?php else : ?>
        <?php echo 'Bu sayfaya erişim izni yok.';
        exit(); ?>
    <?php endif; ?>
    </body>

</html>