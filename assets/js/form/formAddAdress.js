
function formAddAdress(){

    //Formulaire
    let addAdressForm = document.getElementById('addAdressForm');

    let adress = document.getElementById('adress');
    let zipcode = document.getElementById('zipcode');
    let city = document.getElementById('city');
    let country = document.getElementById('country');

    //Erreurs
    let errorAdress = document.getElementById('errorAdress');
    let errorZipcode = document.getElementById('errorZipcode');
    let errorCity = document.getElementById('errorCity');
    let errorCountry = document.getElementById('errorCountry');

    addAdressForm.addEventListener('submit', (event) => {

        let expressionReguliereAdress = /^(\d+)\s([a-zA-Z]+\s?)+(\d+)?$/;
        if(!expressionReguliereAdress.test(adress.value)){
            errorAdress.style.display = 'block';
            event.preventDefault();
        }
        else{

            errorAdress.style.display = 'none';
        }

        let expressionReguliereZipcode = /^\d{5}$/;
        if(!expressionReguliereZipcode.test(zipcode.value)){
            errorZipcode.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorZipcode.style.display = 'none';
        }

        let expressionReguliereCity = /^[a-zA-ZÀ-ÖØ-öø-ÿ]+([\-'\s][a-zA-ZÀ-ÖØ-öø-ÿ]+)*$/;
        if(!expressionReguliereCity.test(city.value)){
            errorCity.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorCity.style.display = 'none';
        }

        let countryLength = document.querySelectorAll('option').length-1;
        if(country.value < 1 || country.value > countryLength){
            errorCountry.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorCountry.style.display = 'none';
        }
    });
}

export { formAddAdress };
