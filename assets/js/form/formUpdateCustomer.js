function formUpdateCustomer(){

    //Formulaire
    let updateCustomerForm = document.getElementById('updateCustomerForm');
    let lastname = document.getElementById('lastname');
    let firstname = document.getElementById('firstname');
    let birthday = document.getElementById('birthday');
    let rfid = document.getElementById('rfid');

    //Erreurs
    let errorLastName = document.getElementById('errorLastName');
    let errorFirstName = document.getElementById('errorFirstName');
    let errorBirthday = document.getElementById('errorBirthday');
    let errorRfid = document.getElementById('errorRfid');

    updateCustomerForm.addEventListener('submit', (event) => {
        
        let expressionReguliereName = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s-']{2,50}$/;
        if(!expressionReguliereName.test(lastname.value)){
            errorLastName.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorLastName.style.display = 'none';
        }

        if(!expressionReguliereName.test(firstname.value)){
            errorFirstName.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorFirstName.style.display = 'none';
        }

        let expressionReguliereBirthday = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
        if(!expressionReguliereBirthday.test(birthday.value)){
            errorBirthday.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorBirthday.style.display = 'none';
        }

        let expressionReguliereRfid = /^([0-9]{10})?$/;
        if(!expressionReguliereRfid.test(rfid.value)){
            console.log(Number.isInteger(rfid.value));
            errorRfid.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorRfid.style.display = 'none';
        }

    });
}

export { formUpdateCustomer };
