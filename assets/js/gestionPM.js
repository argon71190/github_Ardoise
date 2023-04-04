window.addEventListener('DOMContentLoaded', () => {
    
    //Form
    let addPMForm = document.getElementById('addPMForm');
    let PMName = document.getElementById('PMName');

    //Erreurs
    let tvaError = document.getElementById('tvaError');
            console.log(PMName);

    addPMForm.addEventListener('submit', (event) => {
        
        if(PMName.value < 0 || PMName.value > 100){
            tvaError.style.display = 'block';
            event.preventDefault();
        }
    });
});