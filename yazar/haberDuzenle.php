<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haberi Düzenle</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php if ($_SESSION['state'] == "admin" || $_SESSION['state'] == "yazar") : ?>

    <body class="bg-amber-50 min-h-screen flex flex-col">
        <?php include("yazarHeader.php"); ?>
        <div class="w-5/6 mx-auto bg-slate-50 flex-grow flex">
            <main class="p-8 w-full">
                <?php
                include("../baglanti.php");
                if (isset($_GET['haberID'])) {
                    $haberID = intval($_GET['haberID']);
                    $haberler = mysqli_query($baglanti, "SELECT * FROM haberler WHERE id=" . $haberID);
                    $haber = mysqli_fetch_array($haberler);

                    echo '<div class="bg-white p-6 rounded-lg shadow-lg">';
                    echo '    <h2 class="text-2xl font-bold mb-4">Haber Düzenle</h2>';
                    echo '    <form action="haberEditSQL.php" method="post">';
                    echo '        <div class="mb-4">';
                    echo '            <label for="haberBaslik" class="block text-gray-700 font-bold mb-2">Haber Başlığı</label>';
                    echo '            <input type="text" id="haberBaslik" name="haberBaslik" value="' . htmlspecialchars($haber['title'], ENT_QUOTES, 'UTF-8') . '" required class="w-full p-2 border border-gray-300 rounded">';
                    echo '        </div>';
                    echo '        <div class="mb-4">';
                    echo '            <label for="haberIcerik" class="block text-gray-700 font-bold mb-2">Haber İçeriği</label>';
                    echo '            <textarea id="haberIcerik" name="haberIcerik" required class="w-full p-2 border border-gray-300 rounded h-40">' . htmlspecialchars($haber['content'], ENT_QUOTES, 'UTF-8') . '</textarea>';
                    echo '        </div>';
                    echo '        <div class="mb-4">';
                    echo '            <label for="formKategori" class="block text-gray-700 font-bold mb-2">Kategori</label>';
                    echo '            <select name="formKategori" id="hKategori" class="mb-4 block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">';
                    $kategoriler = mysqli_query($baglanti, "SELECT kategori_adi FROM kategoriler");
                    while ($ksatir = mysqli_fetch_array($kategoriler)) {
                        $selected = $ksatir['kategori_adi'] == $haber['kategori'] ? 'selected' : '';
                        echo '<option value="' . $ksatir['kategori_adi'] . '" ' . $selected . '>' . $ksatir['kategori_adi'] . '</option>';
                    }
                    echo '            </select>';
                    echo '        </div>';
                    echo '        <div class="mb-4">';
                    echo '            <label for="haberResim" class="block text-gray-700 font-bold mb-2">Haber Resmi</label>';
                    echo '            <input type="text" id="haberResim" value="' . htmlspecialchars($haber['image_url'], ENT_QUOTES, 'UTF-8') . '" name="haberResim" required class="w-full p-2 border border-gray-300 rounded">';
                    echo '        </div>';
                    echo '        <div class="flex justify-end space-x-2">';
                    echo '          <input type="text" style="display:none;" name="formID" value="' . $haberID . '">';
                    echo '            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kaydet</button>';
                    echo '        </div>';
                    echo '    </form>';
                    echo '</div>';
                }
                ?>
            </main>
        </div>

    <?php else : ?>
        <?php echo 'Bu sayfaya erişim izni yok.';
        exit(); ?>
    <?php endif; ?>
    </body>

</html>