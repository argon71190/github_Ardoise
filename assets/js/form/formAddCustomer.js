
function formAddCustomer(){

    //Formulaire
    let addCustomerForm = document.getElementById('addCustomerForm');
    let lastname = document.getElementById('lastname');
    let firstname = document.getElementById('firstname');
    let birthday = document.getElementById('birthday');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let confirmPassword = document.getElementById('confirm_password');
    let rfid = document.getElementById('rfid');

    //Erreurs
    let errorLastName = document.getElementById('errorLastName');
    let errorFirstName = document.getElementById('errorFirstName');
    let errorBirthday = document.getElementById('errorBirthday');
    let errorEmail = document.getElementById('errorEmail');
    let errorPassword = document.getElementById('errorPassword');
    let errorSecondPassword = document.getElementById('errorSecondPassword');
    let errorRfid = document.getElementById('errorRfid');

    addCustomerForm.addEventListener('submit', (event) => {
        
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

        let expressionReguliereEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(!expressionReguliereEmail.test(email.value)){
            errorEmail.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorEmail.style.display = 'none';
        }
        let expressionRegulierePassword = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/
        if (!expressionRegulierePassword.test(password.value)){
            errorPassword.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorPassword.style.display = 'none';
        }

        if(confirmPassword.value != password.value){
            errorSecondPassword.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorSecondPassword.style.display = 'none';
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

export { formAddCustomer };
