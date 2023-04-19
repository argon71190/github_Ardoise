
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

        let expressionReguliereRfid = /^([0-9]{10})?$/;
        if(!expressionReguliereRfid.test(rfid.value)){
            errorRfid.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorRfid.style.display = 'none';
        }

    });
}

export { formAddCustomer };
