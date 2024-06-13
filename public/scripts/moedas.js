function getCurrencies() {
    fetch('https://economia.awesomeapi.com.br/json/last/USD-BRL,EUR-BRL,BTC-BRL,ETH-BRL,DOGE-BRL')
        .then(response => response.json())
        .then(data => {
            // insert into .currencies with html
            const currencies = document.querySelector('.currencies');
            const currenciesData = data;
            console.log(currenciesData);
            currencies.innerHTML += `
            <div class="currency">
                <h3>Dólar</h3>
                <span class="value"><b>Valor:</b> ${currenciesData.USDBRL.high}</span>
                <span class="variation"><b>Variação:</b> ${currenciesData.USDBRL.varBid}</span>
                <span class="date"><b>Data:</b> ${currenciesData.USDBRL.create_date}</span>
            </div>
            <div class="currency">
                <h3>Euro</h3>
                <span class="value"><b>Valor:</b> ${currenciesData.EURBRL.high}</span>
                <span class="variation"><b>Variação:</b> ${currenciesData.EURBRL.varBid}</span>
                <span class="date"><b>Data:</b> ${currenciesData.EURBRL.create_date}</span>
            </div>
            <div class="currency">
                <h3>Bitcoin</h3>
                <span class="value"><b>Valor:</b> ${currenciesData.BTCBRL.high}</span>
                <span class="variation"><b>Variação:</b> ${currenciesData.BTCBRL.varBid}</span>
                <span class="date"><b>Data:</b> ${currenciesData.BTCBRL.create_date}</span>
            </div>
            <div class="currency">
                <h3>Ethereum</h3>
                <span class="value"><b>Valor:</b> ${currenciesData.ETHBRL.high}</span>
                <span class="variation"><b>Variação:</b> ${currenciesData.ETHBRL.varBid}</span>
                <span class="date"><b>Data:</b> ${currenciesData.ETHBRL.create_date}</span>
            </div>
        `;
        });
}
getCurrencies();