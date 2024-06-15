<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include("header.php"); ?>
    <main class="bg-slate-50 w-5/6 mx-auto p-8">
        <div class="flex flex-wrap">

            <div class="flex gap-4 w-full">
            <div class="w-1/2">
            <?php include("manset.php"); ?>
            </div>
            <div class="bg-white shadow-md h-max mt-4 border-1 w-1/2">
            <table class="min-w-full bg-white rounded-lg">
            <thead>
                <tr class="w-full bg-gray-200 text-left text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">Döviz</th>
                    <th class="py-3 px-6">Alış</th>
                    <th class="py-3 px-6">Satış</th>
                </tr>
            </thead>
            <tbody id="exchange-rate-body" class="text-gray-600 text-sm font-light">
                <!-- Döviz Kurları Burada -->
            </tbody>
        </table>
            </div>
            </div>

            <div class="flex flex-wrap">
                <?php
                include("baglanti.php");

                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $limit = 10;
                $offset = ($page - 1) * $limit;

                $total_haberler = mysqli_query($baglanti, "SELECT COUNT(*) as count FROM haberler");
                $total_count = mysqli_fetch_assoc($total_haberler)['count'];
                $total_pages = ceil($total_count / $limit);

                $haberler = mysqli_query($baglanti, "SELECT * FROM haberler ORDER BY id DESC LIMIT $limit OFFSET $offset");
                $haberlerArray = array();
                while ($satir = mysqli_fetch_array($haberler)) {
                    $haberlerArray[] = $satir;
                }

                foreach ($haberlerArray as $satir) {
                    echo '<div class="w-1/2 p-4">';
                    echo '<div class="bg-white shadow-md h-full rounded-lg overflow-hidden flex">';
                    echo '    <div class="w-1/3">';
                    echo '        <img src="' . htmlspecialchars($satir['image_url'], ENT_QUOTES, 'UTF-8') . '" alt="Haber Fotoğrafı" class="w-full h-full object-cover">';
                    echo '    </div>';
                    echo '    <div class="w-2/3 p-4 flex flex-col justify-between">';
                    echo '        <a href="haber.php?id=' . $satir['id'] . '">';
                    if(strlen($satir['title']) > 50) {
                        echo '            <h2 class="text-lg font-bold mb-2">'  . substr(strip_tags(htmlspecialchars($satir['title'], ENT_QUOTES, 'UTF-8')), 0, 50)  . '[...]</h2>';
                    } else {
                        echo '            <h2 class="text-lg font-bold mb-2">'  . htmlspecialchars($satir['title'], ENT_QUOTES, 'UTF-8')  . '</h2>';
                    }
                    echo '        </a>';
                    echo '        <p class="text-gray-700 flex-grow mb-4">' . substr(strip_tags($satir['content']), 0, 150) . '[...]</p>';
                    echo '        <div class="flex justify-between items-center text-gray-500">';
                    echo '            <p class="text-sm">' . htmlspecialchars($satir['author'], ENT_QUOTES, 'UTF-8') . '</p>';
                    echo '            <p class="text-sm">' . DateTime::createFromFormat('Y-m-d', $satir['publish_date'])->format('d-m-Y') . '</p>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                    echo '</div>';
                }

                mysqli_close($baglanti);
                ?>
            </div>

        </div>

        <div class="flex justify-center mt-4">
        <?php if ($page > 1) : ?>
            <a href="?page=<?php echo $page - 1; ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2">Önceki Sayfa</a>
        <?php endif; ?>
        <?php if ($page < $total_pages) : ?>
            <a href="?page=<?php echo $page + 1; ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Sonraki Sayfa</a>
        <?php endif; ?>
    </div>
    <script src="currency.js"></script>
    </main>
    <?php include("footer.php"); ?>
    </div>
</body>

</html>