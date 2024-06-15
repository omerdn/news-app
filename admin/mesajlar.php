<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        table {
            border-collapse: collapse;
            background-color: #fff;

        }

        table tr,
        table td,
        table th {
            border: 1px solid #bbb;
        }

        table th {
            background-color: brown;
            color: #fff;
            font-weight: 600;
        }

        table td {
            background-color: gray;

        }
    </style>
</head>
<?php if ($_SESSION['state'] == "admin") : ?>

    <body class="bg-amber-50 min-h-screen flex flex-col">
        <?php include("adminHeader.php"); ?>
        <div class="w-5/6 mx-auto bg-slate-50 flex-grow flex">
            <main class="p-8 w-full">

                <?php
                include("../baglanti.php");

                $limit = 20;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                $total_records_query = mysqli_query($baglanti, "SELECT COUNT(*) FROM mesajlar");
                $total_records = mysqli_fetch_array($total_records_query)[0];

                $total_pages = ceil($total_records / $limit);

                $liste = "SELECT * FROM mesajlar LIMIT $limit OFFSET $offset";
                $sonuc = $baglanti->query($liste);

                while ($veri_cek = $sonuc->fetch_assoc()) {
                    echo '<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 mb-6">';
                    echo '<div class="grid grid-cols-5 gap-4 items-center">';
                    echo '<div>';
                    echo '    <p class="font-bold">İsim:</p>';
                    echo '    <p>' . $veri_cek['isim'] . '</p>';
                    echo '</div>';
                    echo '<div>';
                    echo '    <p class="font-bold">Telefon:</p>';
                    echo '    <p>' . $veri_cek['telefon'] . '</p>';
                    echo '</div>';
                    echo '<div>';
                    echo '    <p class="font-bold">Email:</p>';
                    echo '    <p>' . $veri_cek['email'] . '</p>';
                    echo '</div>';
                    echo '<div>';
                    echo '    <p class="font-bold">Konu Başlığı:</p>';
                    echo '    <p>' . substr(strip_tags($veri_cek['konu']), 0, 30) . '...</p>';
                    echo '</div>';
                    echo '<div class="flex space-x-2 justify-end">';
                    echo '    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"><a href="mesaj.php?mesaj_id=' . $veri_cek['mesaj_id'] . '">Göster</a></button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '<div class="flex justify-center mt-4">';
                if ($page > 1) {
                    echo '<a href="?page=' . ($page - 1) . '" class="px-3 py-2 bg-gray-200 text-gray-800 rounded-lg mx-1">Önceki</a>';
                }
                if ($page < $total_pages) {
                    echo '<a href="?page=' . ($page + 1) . '" class="px-3 py-2 bg-gray-200 text-gray-800 rounded-lg mx-1">Sonraki</a>';
                }
                echo '</div>';
                ?>

        </div>
        </main>
        </div>

    <?php else : ?>
        <?php echo 'Bu sayfaya erişim izni yok.';
        exit(); ?>
    <?php endif; ?>

</html>