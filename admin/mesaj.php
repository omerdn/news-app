<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>" "</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php if ($_SESSION['state'] == "admin") : ?>

    <body class="bg-amber-50 min-h-screen flex flex-col">
        <?php include("adminHeader.php"); ?>
        <div class="w-5/6 mx-auto bg-slate-50 flex-grow flex">
            <main class="p-8 w-full">
                <?php
                include("../baglanti.php");
                if (isset($_GET['mesaj_id'])) {
                    $mesaj_id = intval($_GET['mesaj_id']);
                    $mesaj = mysqli_query($baglanti, "SELECT * FROM mesajlar WHERE mesaj_id =" . $mesaj_id);
                    $mesajAyrinti = mysqli_fetch_array($mesaj);
                    echo '<body class="bg-gray-100 p-8">';
                    echo '    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">';
                    echo '        <div class="mb-4">';
                    echo '            <p class="font-bold">İsim:</p>';
                    echo '            <p>' . $mesajAyrinti['isim'] . '</p>';
                    echo '        </div>';
                    echo '        <div class="mb-4">';
                    echo '            <p class="font-bold">Telefon:</p>';
                    echo '            <p>' . $mesajAyrinti['telefon'] . '</p>';
                    echo '        </div>';
                    echo '        <div class="mb-4">';
                    echo '            <p class="font-bold">Email:</p>';
                    echo '            <p>' . $mesajAyrinti['email'] . '</p>';
                    echo '        </div>';
                    echo '        <div class="mb-4">';
                    echo '            <p class="font-bold">Konu Başlığı:</p>';
                    echo '            <p id="mesajBaslik">' . $mesajAyrinti['konu'] . '</p>';
                    echo '        </div>';
                    echo '        <div class="mb-4">';
                    echo '            <p class="font-bold">Mesaj:</p>';
                    echo '            <p>' . $mesajAyrinti['mesaj'] . '.</p>';
                    echo '        </div>';
                    echo '        <div class="flex space-x-2 justify-end">';
                    echo '            <form action="mesajSil.php" method="POST">';
                    echo '                <input type="hidden" name="mesaj_id" value="' . $mesaj_id . '">';
                    echo '                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Sil</button>';
                    echo '            </form>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '<script>
                        let baslik = document.getElementById("mesajBaslik");
                        document.title = baslik.textContent;
                      </script>';
                }
                ?>
            </main>
        </div>

    <?php else : ?>
        <?php echo 'Bu sayfaya erişim izni yok.';
        exit(); ?>
    <?php endif; ?>

</html>