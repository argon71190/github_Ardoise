window.addEventListener('DOMContentLoaded', () => {
    
    let form = document.getElementById('optionForm');
    let optionName = document.getElementById('optionName');
    let optionShortName = document.getElementById('optionShortName');
    let optionPrice = document.getElementById('optionPrice');
    let userfileOption = document.getElementById('userfileOption');
    let categorieCondiment = document.getElementById('categorieCondiment');
    
    form.addEventListener('submit', (event) => {
        
        if(optionName.length < 3 || optionName.length > 50){
            event.preventDefault();
        }
        
        if(optionShortName.length < 1 || optionShortName.length < 10){
            event.preventDefault();
        }
        
        if(isNaN(optionPrice)){
            event.preventDefault();
        }
        
        if(optionPrice <0.01 || optionPrice > 100){
            event.preventDefault();
        }
        
        if(categorieCondiment == '?'){
            event.preventDefault();
            
        }
        
    });
    

    
});