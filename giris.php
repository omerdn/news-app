<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<?php include("header.php"); ?>
<div class="flex items-center justify-around pt-32 w-2/4 mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-6 text-center">Giriş Yap</h2>
        <form action="session.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Kullanıcı Adı</label>
                <input type="text" id="username" pattern="\S(.*\S)?" name="username" title="-Kullanıcı adında boşluk (' ') bulunamaz" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Kullanıcı adınızı girin">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Şifre</label>
                <input type="password" id="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="Şifrenizi girin">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Giriş Yap
                </button>
            </div>
        </form>
    </div>
    </div>
    </div>
</body>

</html>



