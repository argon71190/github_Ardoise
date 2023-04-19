function formTVA(){

    //Formulaire
    let addTvaForm = document.getElementById('addTvaForm');
    let tvaValue = document.getElementById('tvaValue');

    //Erreurs
    let errorTva = document.getElementById('errorTva');

    addTvaForm.addEventListener('submit', (event) => {
        let expressionRegulierePM = /^[0-9]{1,2}(\.[0-9]{0,1})$/;
        if(!expressionRegulierePM.test(tvaValue.value)){
            errorTva.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorTva.style.display = 'none';
        }
    });

}

export { formTVA };
