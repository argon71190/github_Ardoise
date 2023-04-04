window.addEventListener('DOMContentLoaded', () => {
    
    //Form
    let addPMForm = document.getElementById('addPMForm');
    let PMName = document.getElementById('PMName');

    //Erreurs
    let PMError = document.getElementById('PMError');
            console.log(PMName);

    addPMForm.addEventListener('submit', (event) => {
        
        if(PMName.value.length < 2 || PMName.value.length > 20){
            PMError.style.display = 'block';
            event.preventDefault();
        }
    });
});