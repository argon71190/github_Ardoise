window.addEventListener('DOMContentLoaded', () => {
    
    //Form
    let addTvaForm = document.getElementById('addTvaForm');
    let tvaValue = document.getElementById('tvaValue');

    //Erreurs
    let tvaError = document.getElementById('tvaError');
            console.log(tvaValue);

    addTvaForm.addEventListener('submit', (event) => {
        
        if(tvaValue.value < 0 || tvaValue.value > 100){
            tvaError.style.display = 'block';
            event.preventDefault();
        }
    });
});