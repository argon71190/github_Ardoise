window.addEventListener('DOMContentLoaded', () => {
    
    //Form
    let form = document.getElementById('optionForm');
    let optionName = document.getElementById('optionName');
    let optionShortName = document.getElementById('optionShortName');
    let optionPrice = document.getElementById('optionPrice');
    let userfileOption = document.getElementById('userfileOption');
    let categorieCondiment = document.getElementById('categorieCondiment');
    
    //Erreurs
    let errorName = document.getElementById('errorName');
    let errorShortName = document.getElementById('errorShortName');
    let errorPrice = document.getElementById('errorPrice');
    let errorCategorie = document.getElementById('errorCategorie');
    
    form.addEventListener('submit', (event) => {
        
        if(optionName.length < 3 || optionName.length > 50){
            errorName.style.display = 'block';
            event.preventDefault();
            
        }
        
        if(optionShortName.length < 1 || optionShortName.length < 10){
            errorShortName.style.display = 'block';
            event.preventDefault();
        }
        
        if(isNaN(optionPrice)){
            errorPrice.style.display = 'block';
            event.preventDefault();
        }
        
        if(optionPrice <0.01 || optionPrice > 100){
            errorPrice.style.display = 'block';
            event.preventDefault();
        }
        
        if(categorieCondiment == '?'){
            errorCategorie.style.display = 'block';
            event.preventDefault();
            
        }
        
    });
    

    
});