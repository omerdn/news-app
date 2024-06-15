<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>" "
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include("header.php"); ?>
    <div class="bg-slate-50 h-max pb-32 w-5/6 mx-auto">
        <main class="w-full">

            <?php
            include("baglanti.php");
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $haber = mysqli_query($baglanti, "SELECT * FROM haberler WHERE id =" . $id);
                $haberAyrinti = mysqli_fetch_array($haber);
                echo '<div class="flex justify-center">';
                echo '    <div class="w-full">';
                echo '        <h2 id="haberBasligi" class="text-3xl font-bold p-4">' . htmlspecialchars($haberAyrinti["title"], ENT_QUOTES, 'UTF-8') . '</h2>';
                echo '        <p id="kategori" class="text-sm ml-4"><strong>Kategori: </strong>' . htmlspecialchars($haberAyrinti["kategori"], ENT_QUOTES, 'UTF-8') . '</p>';
                echo '        <div class="p-4 border-b mb-8">';
                echo '            <div class="flex justify-between items-center text-gray-500">';
                echo '                <p class="text-sm">Yazar: <strong>' . htmlspecialchars($haberAyrinti['author'], ENT_QUOTES, 'UTF-8') . '</strong></p>';
                echo '                <p class="text-sm">Tarih: <strong>' . DateTime::createFromFormat('Y-m-d', $haberAyrinti['publish_date'])->format('d-m-Y') . '</strong></p>';
                echo '            </div>';
                echo '            </div>';
                echo '        <center><img src="' . htmlspecialchars($haberAyrinti["image_url"], ENT_QUOTES, 'UTF-8') . '" alt="Haber Fotoğrafı" class="shadow-lg w-1/2 h-96 object-cover"></center>';
                echo '        <div class="px-32 pt-8">';
                echo '            <div><p class="text-gray-700 mb-4 text-lg">' . nl2br(htmlspecialchars($haberAyrinti["content"], ENT_QUOTES, 'UTF-8')) . '</p></div>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
                echo '<script>
                        let baslik = document.getElementById("haberBasligi");
                        document.title = baslik.textContent;
                      </script>';
            } else {
                echo "ID parametresi eksik.";
            }
            mysqli_close($baglanti);
            ?>

            <hr class="mt-32 mb-4">
            <form class="space-y-4 ml-4 w-1/2" method="POST" action="yorumSQL.php">
                <input type="text" style="display:none;" name="formID" id="formID" value="<?php echo $id ?>">
                <div>
                    <textarea maxlength="180" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Bu haber hakkında ne düşünüyorsunuz? (Maksimum 180 karakter)" name="yorum_icerik"></textarea>
                </div>
                <div class="flex space-x-4">
                    <?php
                    if ($_SESSION['state'] == "guest") {
                        echo '<input maxlength="50" type="text" class="flex-1 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Rumuz" name="yorum_isim" />';
                    } else {
                        echo '<input maxlength="50" type="text" class="flex-1 p-4 border border-gray-300 rounded-lg focus:outline-none cursor-not-allowed bg-gray-300" value="' . $_SESSION['kullaniciAdi'] . '" name="yorum_isim" readonly/>';
                    }
                    ?>
                    <button type="submit" class="bg-gray-500 text-white px-6 py-4 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        GÖNDER
                    </button>
                </div>
            </form>

            <div class="w-4xl p-6 mb-6 mt-6">
                <h3 class="text-2xl font-semibold mb-4">Yorumlar</h3>
                <?php
                include("baglanti.php");
                $yorumlar = mysqli_query($baglanti, "SELECT * FROM `yorumlar` WHERE haber_id = $id AND onaylı = 'onaylanan'");

                $yorumKontrol = mysqli_query($baglanti, "SELECT * FROM `yorumlar` WHERE haber_id =$id AND onaylı = 'onaylanan'");

                if (mysqli_num_rows($yorumKontrol) <= 0) {
                    echo 'Henüz bir yorum yok. İlk yorum yapan siz olun!';
                } else {
                    while ($satir = mysqli_fetch_array($yorumlar)) {
                        echo '<div class="border-b border-gray-200 pb-4 mb-4">';
                        echo '<div class="flex justify-between items-center mb-2">';
                        echo '<p class="font-bold text-gray-800">' . $satir['yorum_author'] . '</p>';
                        echo '<p class="text-sm text-gray-600">' . DateTime::createFromFormat('Y-m-d', $satir['yorum_tarih'])->format('d-m-Y') . '</p>';
                        echo '</div>';
                        echo '<p class="text-gray-700">' . $satir['yorum_content'] . '</p>';
                        echo '</div>';
                    }
                }
                ?>
            </div>

    </div>

    </main>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>