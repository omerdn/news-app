<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bize Ulaşın</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
<?php include("../header.php"); ?>
    <div class="bg-slate-50 h-full pb-32 w-5/6 mx-auto">
        <main class="container mx-auto p-8">
        <div class="flex">
            <div class="w-1/4">
                <h2 class="font-bold text-lg mb-4">Haber Sitesi</h2>
                <ul class="space-y-2">
                    <li><a href="hakkimizda.php" class="block text-gray-700 font-bold hover:text-gray-900">Hakkımızda</a></li>
                    <li><a href="yazarlar.php" class="block text-gray-700 font-bold hover:text-gray-900">Yazarlarımız</a></li>
                </ul>
            </div>
            <div class="w-3/4 ml-8">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-4">Yazar Ekibimiz</h1>
                    <table class="bg-white rounded-lg shadow-md">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Yazar</th>
                                <th class="py-2 px-4 border-b">E-Mail</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                        include("../baglanti.php");

                        $yazarlar = mysqli_query($baglanti, "SELECT * FROM `kullanicilar` WHERE accountState = 'yazar'");
                        while ($satir = mysqli_fetch_array($yazarlar)) {
                            echo '<tr>';
                            echo '<td class="py-2 px-4 border-b"><center>' . $satir['kullaniciAdi'] . '</center></td>';
                            echo '<td class="py-2 px-4 border-b"><center>' . $satir['mail'] . '</center></td>';
                            echo '</tr>';
                        }
                    ?>
                    </tbody>
                    </table>                    
                </div>
            </div>
        </main>
        </div>
    </div>
<?php include("../footer.php"); ?>

</body>

</html>