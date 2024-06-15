const options = {
  method: "GET",
  url: "https://finans.truncgil.com/today.json",
};

async function getCurrencyData() {
  try {
    const response = await axios.request(options);
    const data = response.data;
    const kurlar = [
      [data.USD, "USD - $"],
      [data.EUR, "EUR - €"],
      [data.GBP, "GBP - £"],
      [data.CAD, "CAD - $"],
      [data.RUB, "RUB - ₽"],
      [data.JPY, "JPY - ¥"],
      [data.gumus, "GÜMÜŞ"]
    ];
    let Alis;
    let Satis;

    kurlar.forEach((element) => {
      Alis = parseFloat(element[0].Alış.replace(",", "."));
      Satis = parseFloat(element[0].Satış.replace(",", "."));
      const tbody = document.getElementById("exchange-rate-body");
      const tr = document.createElement("tr");
      tr.classList.add("border-b", "border-gray-200", "hover:bg-gray-100");

      const tdCurrency = document.createElement("td");
      tdCurrency.classList.add("py-3", "px-6");
      tdCurrency.textContent = element[1];
      tr.appendChild(tdCurrency);

      const tdAlis = document.createElement("td");
      tdAlis.classList.add("py-3", "px-6");
      tdAlis.textContent = Alis.toFixed(4);
      tr.appendChild(tdAlis);

      const tdSatis = document.createElement("td");
      tdSatis.classList.add("py-3", "px-6");
      tdSatis.textContent = Satis.toFixed(4);
      tr.appendChild(tdSatis);

      tbody.appendChild(tr);
    });
  } catch (error) {
    console.error(error);
    const tbody = document.getElementById("exchange-rate-body");
    const tr = document.createElement("tr");
    const tdError = document.createElement("td");
    tdError.setAttribute("colspan", "3");
    tdError.textContent = "API şu an çalışmıyor.";
    tr.appendChild(tdError);
    tbody.appendChild(tr);
  }
}

getCurrencyData();
