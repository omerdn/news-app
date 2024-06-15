const options = {
    method: "GET",
    url: "https://weatherapi-com.p.rapidapi.com/forecast.json",
    params: {
      q: "Ankara",
      days: "3",
      lang: "tr",
    },
    headers: {
      "x-rapidapi-key": "008f64990dmsh7be593cb8f80d15p127ae9jsn8d90f0c2213c",
      "x-rapidapi-host": "weatherapi-com.p.rapidapi.com",
    },
  };
  
  async function havaDurumuGetir(sehir) {
    try {
      const response = await axios.request({
        method: "GET",
        url: "https://weatherapi-com.p.rapidapi.com/forecast.json",
        params: {
          q: sehir,
          days: "3",
          lang: "tr",
        },
        headers: {
          "x-rapidapi-key": "008f64990dmsh7be593cb8f80d15p127ae9jsn8d90f0c2213c",
          "x-rapidapi-host": "weatherapi-com.p.rapidapi.com",
        },
      });
      let responseData = response.data;
  
      function gunAdi(dateString) {
        const gunler = [
          "Pazar",
          "Pazartesi",
          "Salı",
          "Çarşamba",
          "Perşembe",
          "Cuma",
          "Cumartesi",
        ];
        const date = new Date(dateString);
        const gun = date.getDay();
        return gunler[gun];
      }
  
      const forecast = responseData.forecast.forecastday;
      const cityElement = document.getElementById(`city`);
      cityElement.innerText = sehir.charAt(0).toUpperCase() + sehir.slice(1);
      for (let i = 0; i < 3; i++) {
        const dayNameElement = document.getElementById(`day-name-${i}`);
        const dateElement = document.getElementById(`date-${i}`);
        const weatherIconElement = document.getElementById(`weather-icon-${i}`);
        const temperatureElement = document.getElementById(`temperature-${i}`);
        const minTempElement = document.getElementById(`min-temp-${i}`);
        const maxTempElement = document.getElementById(`max-temp-${i}`);
        const rainChanceElement = document.getElementById(`rain-chance-${i}`);
        const weatherDescElement = document.getElementById(`weather-desc-${i}`);
  
        dayNameElement.innerText = gunAdi(forecast[i].date);
        dateElement.innerText = forecast[i].date;
        weatherIconElement.src = forecast[i].day.condition.icon;
        temperatureElement.innerText = `${forecast[i].day.avgtemp_c}°C`;
        minTempElement.innerText = `Min: ${forecast[i].day.mintemp_c}°C`;
        maxTempElement.innerText = `Max: ${forecast[i].day.maxtemp_c}°C`;
        rainChanceElement.innerText = `Yağmur İhtimali: ${forecast[i].day.daily_chance_of_rain}%`;
        weatherDescElement.innerText = forecast[i].day.condition.text;
      }
    } catch (error) {
      console.error("Hava durumu verisi alınamadı:", error);
    }
  }
  
  havaDurumuGetir("Ankara");

  let sehirAdi = document.getElementById("sehirInput");
  let sehirGuncelleButon = document.getElementById("sehirGuncelle");
  sehirGuncelleButon.addEventListener("click", () => {
    havaDurumuGetir(sehirAdi.value);
  });