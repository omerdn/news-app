<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bize Ulaşın</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<?php include("../header.php"); ?>
    <div class="bg-slate-50 h-full w-5/6 mx-auto">
        <main class="container mx-auto p-8">

        <h3 class="text-2xl font-bold mb-4 text-center">İletişim</h3>
        <p class="text-gray-700 mb-6 text-center">
            Sorularınız, önerileriniz veya geri bildirimleriniz için bizimle iletişime geçmekten çekinmeyin. Size yardımcı olmaktan mutluluk duyarız.
        </p>

        <form action="iletisimEkle.php" method="post">
            <div id="iletisimformu" style="margin-left: 12%;" class="space-y-4 w-3/4 flex flex-col">
                
                    <input type="text" name="ad" placeholder="İsim Soyisim Giriniz:" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="text" name="telefon" placeholder="Telefon Numarasını Giriniz:" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                

                
                    <input type="email" name="email" placeholder="Email adresinizi giriniz:" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="text" name="konu" placeholder="Konu Başlığı:" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                
                <div class="flex flex-col w-full">
                 <textarea name="mesaj" placeholder="Mesaj Giriniz :" cols="30" rows="10" required class="mb-4 w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                 <input type="submit" value="Gönder" class="w-32 bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </form>

        </main>
    </div>
    </div>
    <?php include("../footer.php"); ?>
</body>

</html>