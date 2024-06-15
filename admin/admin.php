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
                <?php
                include("../baglanti.php");

                $mansetler = mysqli_query($baglanti, "SELECT * FROM `manset` ORDER BY `mansetId` ASC");
                $manset = mysqli_fetch_all($mansetler, MYSQLI_ASSOC);

                echo '<form action="mansetSQL.php" method="post" class="space-y-4 p-6 bg-white rounded-lg shadow-lg">';
                foreach ($manset as $index => $eleman) {
                    $inputId = $index + 1;
                    echo '<div class="mb-4">';
                    echo '    <label for="idgiris' . $inputId . '" class="block text-gray-700 font-bold mb-2">Manşet Haber ID ' . $eleman['mansetId'] . '</label>';
                    echo '    <input type="text" id="idgiris' . $inputId . '" name="idgiris' . $inputId . '" class="w-full p-3 border border-gray-300 rounded" value="' . $eleman['haberID'] . '">';
                    echo '</div>';
                }
                echo '<div class="flex justify-end">';
                echo '    <input type="submit" value="Kaydet" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">';
                echo '</div>';
                echo '</form>';
                ?>


            </main>
        </div>

    <?php else : ?>
        <?php echo 'Bu sayfaya erişim izni yok.';
        exit(); ?>
    <?php endif; ?>

</html>