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
        
        if(lastname.value.length < 2 || lastname.value.length > 50){
            errorLastName.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorLastName.style.display = 'none';
        }

        if(firstname.value.length < 2 || firstname.value.length > 50){
            errorFirstName.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorFirstName.style.display = 'none';
        }

        if(birthday.value.length != 10){
            errorBirthday.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorBirthday.style.display = 'none';
        }

        if(isNaN(rfid.value) || (rfid.value.length != 0 && rfid.value.length != 10)){
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
