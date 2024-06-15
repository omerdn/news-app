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
                <form action="yorumlar.php" method="GET" class="mb-4 flex">
                    <input type="text" name="search" placeholder="Yorum mesajı giriniz..." class="flex-grow p-2 border border-gray-300 rounded">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Ara</button>
                </form>
                <?php
                include("../baglanti.php");

                $limit = 20;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                $search = isset($_GET['search']) ? mysqli_real_escape_string($baglanti,$_GET['search']) : '';

                $total_records_query = mysqli_query($baglanti, "SELECT COUNT(*) FROM yorumlar WHERE yorum_content LIKE '%$search%'");
                $total_records = mysqli_fetch_array($total_records_query)[0];

                $total_pages = ceil($total_records / $limit);

                $yorumlar = mysqli_query($baglanti, "SELECT * FROM yorumlar WHERE yorum_content LIKE '%$search%' ORDER BY onaylı ASC LIMIT $limit OFFSET $offset");

                echo '<table class="min-w-full bg-white rounded-lg shadow-md">';
                echo '<thead>';
                echo '<tr>';
                echo '<th class="py-2 px-4 border-b">Yorum ID</th>';
                echo '<th class="py-2 px-4 border-b">Yazar İsmi</th>';
                echo '<th class="py-2 px-4 border-b">Yorum İçeriği</th>';
                echo '<th class="py-2 px-4 border-b">Haber ID</th>';
                echo '<th class="py-2 px-4 border-b">Durum</th>';
                echo '<th class="py-2 px-4 border-b">Yorum Tarihi</th>';
                echo '<th class="py-2 px-4 border-b">İşlemler</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody class="text-gray-600 text-sm font-light">';

                while ($satir = mysqli_fetch_array($yorumlar)) {
                    echo '<tr class="border-b border-gray-200 hover:bg-gray-100">';
                    echo '<td class="py-3 px-6 text-center">' . htmlspecialchars($satir['yorum_id'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td class="py-3 px-6 text-center">' . htmlspecialchars($satir['yorum_author'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td class="py-3 px-6 text-center">' . htmlspecialchars($satir['yorum_content'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td class="py-3 px-6 text-center">' . htmlspecialchars($satir['haber_id'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td class="py-3 px-6 text-center">';
                    if ($satir['onaylı'] == 'bekleyen') {
                        echo '<span class="bg-red-500 text-white py-1 px-3 rounded-full text-xs">Bekleyen</span>';
                    } else {
                        echo '<span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">Onaylanan</span>';
                    }
                    echo '</td>';
                    echo '<td class="py-3 px-6 text-xs text-center">' . DateTime::createFromFormat('Y-m-d', $satir['yorum_tarih'])->format('d-m-Y') . '</td>';
                    echo '<td class="py-2 flex gap-12 justify-center">';
                    if ($satir['onaylı'] == 'bekleyen') {
                    echo '<form class="w-1/5" action="adminYorumOnay.php" method="post">';
                    echo '<input type="hidden" name="yorum_id" value="' . $satir['yorum_id']  . '">';
                    echo '<button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Onay</button>';
                    echo '</form>';
                    echo '<form class="w-1/5" action="adminYorumSil.php" method="post">';
                    echo '<input type="hidden" name="yorum_id" value="' . $satir['yorum_id']  . '">';
                    echo '<button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Sil</button>';
                    echo '</form>';
                    echo '</td>';
                    }
                    if ($satir['onaylı'] == 'onaylanan') {
                    echo '<form class="w-1/5" action="adminYorumSil.php" method="post">';
                    echo '<input type="hidden" name="yorum_id" value="' . $satir['yorum_id']  . '">';
                    echo '<button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Sil</button>';
                    echo '</form>';
                    echo '</td>';
                    }
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