function formPM(){

    //Form
    let addPMForm = document.getElementById('addPMForm');
    let PMName = document.getElementById('PMName');

    //Erreurs
    let errorPM = document.getElementById('errorPM');

    addPMForm.addEventListener('submit', (event) => {
        
        let expressionRegulierePM = /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s-']{2,20}$/;
        if(!expressionRegulierePM.test(PMName.value)){
            errorPM.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorPM.style.display = 'none';
        }
    });
}
export { formPM };