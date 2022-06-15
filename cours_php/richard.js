const changeCurrency = () => {

    let myHeaders = new Headers();
    myHeaders.append("apikey", "F6B9xvtn8WU4tyUdQOzP4omS2vJdiifQ");

    let requestOptions = {
        method: 'GET',
        redirect: 'follow',
        headers: myHeaders
    };

    //je récupere la valeur des options 1 et 2
    let firstCurrency = document.querySelector(".currency1").value;
    let secondCurrency = document.querySelector("currency2").value;
    // je récupere la valeur de l'input
    let amount = document.querySelctor(".amount").value;
    
    fetch("https://api.apilayer.com/exchangerates_data/convert?to"+secondCurrency+"&from="+firstCurrency+"&amount="+amount+","+requestOptions)
        .then(response => {
            if (response.ok()) {
                response.json()
                    .then(data => {
                        let resultat = document.querySelector(".resultChange");
                        resultat.innerHTML = Math.floor(data.result);
                    })
            } else {
                console.log("ERROR");
            }
        });
    }



/*let element = document.getElementById("zone_meteo");
    element.innerHTML =  Math.floor(data.main.temp)+"°";
    console.log(data);*/
