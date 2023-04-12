function formTVA(){

    //Formulaire
    let addTvaForm = document.getElementById('addTvaForm');
    let tvaValue = document.getElementById('tvaValue');

    //Erreurs
    let errorTva = document.getElementById('errorTva');

    addTvaForm.addEventListener('submit', (event) => {
        
        if(isNaN(tvaValue.value) || tvaValue.value < 0 || tvaValue.value > 100 || !Number.isInteger(tvaValue.value*100) || tvaValue.value==""){
            errorTva.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorTva.style.display = 'none';
        }
    });

}

export { formTVA };
