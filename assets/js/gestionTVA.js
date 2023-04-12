window.addEventListener('DOMContentLoaded', () => {
    
    //Form
    let addTvaForm = document.getElementById('addTvaForm');
    let tvaValue = document.getElementById('tvaValue');

    //Erreurs
    let errorTva = document.getElementById('errorTva');

    addTvaForm.addEventListener('submit', (event) => {
        console.log("here");
        
        if(isNaN(tvaValue.value) || tvaValue.value < 0 || tvaValue.value > 100 || !Number.isInteger(tvaValue.value*100)){
            errorTva.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorTva.style.display = 'none';
        }
    });
});