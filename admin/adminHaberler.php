<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php if ($_SESSION['state'] == "admin") : ?>

    <body class="bg-amber-50 min-h-screen flex flex-col">
        <?php include("adminHeader.php"); ?>
        <div class="w-5/6 mx-auto bg-slate-50 flex-grow flex">
            <main class="p-8 w-full">
            <form action="adminHaberler.php" method="GET" class="mb-4 flex">
                        <input type="text" name="search" placeholder="Haber başlığı ara..." class="flex-grow p-2 border border-gray-300 rounded">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Ara</button>
                    </form>
                <?php
                include("../baglanti.php");

                $limit = 20;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                $search = isset($_GET['search']) ? mysqli_real_escape_string($baglanti,$_GET['search']) : '';

                $total_records_query = mysqli_query($baglanti, "SELECT COUNT(*) FROM haberler WHERE title LIKE '%$search%'");
                $total_records = mysqli_fetch_array($total_records_query)[0];

                $total_pages = ceil($total_records / $limit);

                $haberler = mysqli_query($baglanti, "SELECT * FROM haberler WHERE title LIKE '%$search%' ORDER BY id DESC LIMIT $limit OFFSET $offset");

                echo '<table class="min-w-full bg-white rounded-lg shadow-md">';
                echo '<thead>';
                echo '<tr>';
                echo '<th class="py-2 px-4 border-b">Haber ID</th>';
                echo '<th class="py-2 px-4 border-b">Başlık</th>';
                echo '<th class="py-2 px-4 border-b">Yazar</th>';
                echo '<th class="py-2 px-4 border-b">Kategori</th>';
                echo '<th class="py-2 px-4 border-b">Tarih</th>';
                echo '<th class="py-2 px-4 border-b">İşlemler</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($satir = mysqli_fetch_array($haberler)) {
                    echo '<tr>';
                    echo '<td class="py-2 px-4 border-b"><center>' . htmlspecialchars($satir['id'], ENT_QUOTES, 'UTF-8') . '</center></td>';
                    echo '<td class="py-2 px-4 border-b"><center>' . htmlspecialchars($satir['title'], ENT_QUOTES, 'UTF-8') . '</center></td>';
                    echo '<td class="py-2 px-4 border-b"><center>' . htmlspecialchars($satir['author'], ENT_QUOTES, 'UTF-8') . '</center></td>';
                    echo '<td class="py-2 px-4 border-b"><center>' . htmlspecialchars($satir['kategori'], ENT_QUOTES, 'UTF-8') . '</center></td>';
                    echo '<td class="py-2 px-4 border-b"><center>' . DateTime::createFromFormat('Y-m-d', $satir['publish_date'])->format('d-m-Y') . '</center></td>';
                    echo '<td class="py-2 px-4 border-b flex gap-8 justify-center">';
                    echo '<button class="bg-blue-500 text-white px-4 py-2 rounded"><a href="adminHaberDuzenle.php?haberID=' . $satir['id'] . '">Düzenle</a></button>';
                    echo '<form class="w-1/5" action="adminHaberSil.php" method="post">';
                    echo '<input type="hidden" name="haber_id" value="' . $satir['id']  . '">';
                    echo '<button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Sil</button>';
                    echo '</form>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';

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