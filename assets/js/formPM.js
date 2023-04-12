function formPM(){

    //Form
    let addPMForm = document.getElementById('addPMForm');
    let PMName = document.getElementById('PMName');

    //Erreurs
    let errorPM = document.getElementById('errorPM');

    addPMForm.addEventListener('submit', (event) => {
        
        if(PMName.value.length < 2 || PMName.value.length > 20){
            errorPM.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorPM.style.display = 'none';
        }
    });
}
export { formPM };