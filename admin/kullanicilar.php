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
                <div class="container mx-auto">
                    <form action="kullanicilar.php" method="GET" class="mb-4 flex">
                        <input type="text" name="search" placeholder="Kullanıcı adı ara..." class="flex-grow p-2 border border-gray-300 rounded">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Ara</button>
                    </form>

                    <?php
                    include("../baglanti.php");

                    $limit = 20;
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;

                    $search = isset($_GET['search']) ? mysqli_real_escape_string($baglanti,$_GET['search']) : '';

                    $total_records_query = mysqli_query($baglanti, "SELECT COUNT(*) FROM kullanicilar WHERE kullaniciAdi LIKE '%$search%'");
                    $total_records = mysqli_fetch_array($total_records_query)[0];

                    $total_pages = ceil($total_records / $limit);

                    $kullanicilar = mysqli_query($baglanti, "SELECT * FROM kullanicilar WHERE kullaniciAdi LIKE '%$search%' ORDER BY kullaniciID DESC LIMIT $limit OFFSET $offset");

                    echo '<table class="min-w-full bg-white rounded-lg shadow-md">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th class="py-2 px-4 border-b">Kullanıcı ID</th>';
                    echo '<th class="py-2 px-4 border-b">Kullanıcı Adı</th>';
                    echo '<th class="py-2 px-4 border-b">E-Mail</th>';
                    echo '<th class="py-2 px-4 border-b">Hesap Durumu</th>';
                    echo '<th class="py-2 px-4 border-b">İşlemler</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while ($satir = mysqli_fetch_array($kullanicilar)) {
                        echo '<tr>';
                        echo '<td class="py-2 px-4 border-b"><center>' . $satir['kullaniciID'] . '</center></td>';
                        echo '<td class="py-2 px-4 border-b"><center>' . $satir['kullaniciAdi'] . '</center></td>';
                        echo '<td class="py-2 px-4 border-b"><center>' . $satir['mail'] . '</center></td>';
                        echo '<td class="py-2 px-4 border-b"><center>' . $satir['accountState'] . '</center></td>';
                        echo '<td class="py-2 px-4 border-b flex gap-8 justify-center">';
                        echo '<button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="openModal(' . $satir['kullaniciID'] . ', \'' . $satir['kullaniciAdi'] . '\', \'' . $satir['mail'] . '\', \'' . $satir['accountState'] . '\')">Düzenle</button>';
                        echo '<form class="w-1/5" action="kullaniciSil.php" method="post">';
                        echo '<input type="hidden" name="kullanici_id" value="' . $satir['kullaniciID'] . '">';
                        echo '<button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Sil</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';

                    echo '<div class="flex justify-center mt-4">';
                    if ($page > 1) {
                        echo '<a href="?search=' . $search . '&page=' . ($page - 1) . '" class="px-3 py-2 bg-gray-200 text-gray-800 rounded-lg mx-1">Önceki</a>';
                    }
                    if ($page < $total_pages) {
                        echo '<a href="?search=' . $search . '&page=' . ($page + 1) . '" class="px-3 py-2 bg-gray-200 text-gray-800 rounded-lg mx-1">Sonraki</a>';
                    }
                    echo '</div>';
                    ?>
                </div>

                <div id="modal1" class="fixed z-500 inset-0 w-full h-full bg-orange-950/50 hidden">
                    <div id="modal2" class="fixed z-10 inset-0 overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="bg-white rounded-lg shadow-xl w-1/3 p-6" onclick="event.stopPropagation()">
                                <form action="kullaniciEdit.php" method="post">
                                    <h2 class="text-xl font-bold mb-4">Kullanıcı Düzenle</h2>
                                    <label class="block mb-2">Kullanıcı Adı</label>
                                    <input name="formIsim" type="text" class="w-full mb-4 p-2 border rounded" id="kAdi" value="">
                                    <label class="block mb-2">E-Mail</label>
                                    <input name="formEmail" type="text" class="w-full mb-4 p-2 border rounded" id="kEmail" value="">
                                    <label class="block mb-2">Hesap Durumu</label>
                                    <select name="formState" id="kState" class="mb-4 block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="admin">admin</option>
                                        <option value="uye">uye</option>
                                        <option value="yazar">yazar</option>
                                    </select>
                                    <input type="text" name="formID" style="display: none;" id="kKullaniciID" value="">
                                    <div class="flex justify-end space-x-2">
                                        <input type="submit" value="Kaydet" class="bg-blue-500 text-white px-4 py-2 rounded" style="cursor: pointer;" onclick="kaydetModal()">
                                        <input value="Kapat" class="bg-gray-500 text-white px-4 py-2 rounded w-20 text-center" style="cursor: pointer;" onclick="closeModal()">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <script>
            function openModal(id, kullaniciAd, email, state) {
                document.getElementById("modal1").classList.remove('hidden');
                document.getElementById("kAdi").value = kullaniciAd;
                document.getElementById("kEmail").value = email;
                document.getElementById("kState").value = state;
                document.getElementById("kKullaniciID").value = id;
            }

            function closeModal() {
                document.getElementById("modal1").classList.add('hidden');
            }

            function kaydetModal() {
                document.getElementById("modal1").classList.add('hidden');
            }
        </script>



        </main>
        </div>

    <?php else : ?>
        <?php echo 'Bu sayfaya erişim izni yok.';
        exit(); ?>
    <?php endif; ?>

</html>