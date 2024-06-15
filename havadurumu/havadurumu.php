<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bize Ulaşın</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include("../header.php"); ?>
    <div class="bg-slate-50 h-max w-5/6 mx-auto pb-32">
        <main> 
            <center class="pt-8">
                <p class="text-3xl font-extrabold mb-20"><span id="city"></span> İçin 3 Günlük Hava Durumu</p>
            </center>
            <center class="mb-8">
            <input type="text" id="sehirInput" class="w-64 p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Şehir giriniz...">
            <button id="sehirGuncelle" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Lokasyon Değiştir
            </button>
            </center>
            <div class="flex justify-around">
                <div class="w-1/5 rounded overflow-hidden shadow-lg bg-white p-6">
                    <div class="text-center">
                        <div id="day-name-0" class="text-2xl font-bold text-gray-900"></div>
                        <div id="date-0" class="text-lg text-gray-700"></div>
                        <img id="weather-icon-0" src="https://cdn.weatherapi.com/weather/64x64/day/116.png" alt="Hava Durumu" class="mx-auto my-4">
                        <div id="temperature-0" class="text-3xl font-semibold text-gray-800"></div>
                        <div id="min-max-temp-0" class="text-sm text-gray-600 mt-2">
                            <span id="min-temp-0"></span> |
                            <span id="max-temp-0"></span>
                        </div>
                        <div id="rain-chance-0" class="text-sm text-gray-400 mt-2"></div>
                        <div id="weather-desc-0" class="text-gray-700 mt-4 italic"></div>
                    </div>
                </div>

                <div class="w-1/5 rounded overflow-hidden shadow-lg bg-white p-6">
                    <div class="text-center">
                        <div id="day-name-1" class="text-2xl font-bold text-gray-900"></div>
                        <div id="date-1" class="text-lg text-gray-700"></div>
                        <img id="weather-icon-1" src="https://cdn.weatherapi.com/weather/64x64/day/116.png" alt="Hava Durumu" class="mx-auto my-4">
                        <div id="temperature-1" class="text-3xl font-semibold text-gray-800"></div>
                        <div id="min-max-temp-1" class="text-sm text-gray-600 mt-2">
                            <span id="min-temp-1"></span> |
                            <span id="max-temp-1"></span>
                        </div>
                        <div id="rain-chance-1" class="text-sm text-gray-400 mt-2"></div>
                        <div id="weather-desc-1" class="text-gray-700 mt-4 italic"></div>
                    </div>
                </div>

                <div class="w-1/5 rounded overflow-hidden shadow-lg bg-white p-6">
                    <div class="text-center">
                        <div id="day-name-2" class="text-2xl font-bold text-gray-900"></div>
                        <div id="date-2" class="text-lg text-gray-700"></div>
                        <img id="weather-icon-2" src="https://cdn.weatherapi.com/weather/64x64/day/116.png" alt="Hava Durumu" class="mx-auto my-4">
                        <div id="temperature-2" class="text-3xl font-semibold text-gray-800"></div>
                        <div id="min-max-temp-2" class="text-sm text-gray-600 mt-2">
                            <span id="min-temp-2"></span> |
                            <span id="max-temp-2"></span>
                        </div>
                        <div id="rain-chance-2" class="text-sm text-gray-400 mt-2"></div>
                        <div id="weather-desc-2" class="text-gray-700 mt-4 italic"></div>
                    </div>
                </div>
            </div>


            <script src="havadurumu.js"></script>
        </main>
    </div>
    </div>
    <?php include("../footer.php"); ?>
</body>

</html>