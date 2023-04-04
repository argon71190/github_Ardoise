"use strict";

window.addEventListener('DOMContentLoaded', () => {
    
    //Form
    let form = document.querySelector('.form');
    let optionName = document.querySelector('.formName');
    let optionShortName = document.querySelector('.formShortName');
    let optionPrice = document.querySelector('.formPrice');
    let categorie = document.querySelector('.formCategorie');
    let optionSubmit = document.querySelector('.buttonSubmit');
    
    //Article form
    if(document.getElementById('spl_tva') != 'undefined'){
        var formTva = document.getElementById('spl_tva');
    }
    
    //Erreurs
    let errorName = document.querySelector('.errorName');
    let errorShortName = document.querySelector('.errorShortName');
    let errorPrice1 = document.querySelector('.errorPrice1');
    let errorPrice2 = document.querySelector('.errorPrice2');
    let errorCategorie = document.querySelector('.errorCategorie');
    
    //Article erreurs
    if(document.getElementById('errorTva') != 'undefined'){
        var errorTva =document.getElementById('errorTva');
    }

    optionSubmit.addEventListener('click', (event)=> {
        if(optionName.value.length < 3 || optionName.value.length > 50){
            errorName.style.display = 'block';
        }
        else{
            errorName.style.display = 'none';
        }
        
        
        if(optionShortName.value.length < 1 || optionShortName.value.length > 10){
            errorShortName.style.display = 'block';
        }
        else{
            errorShortName.style.display = 'none';
        }

        
        if(optionPrice.value == "" || isNaN(optionPrice.value)){
            errorPrice1.style.display = 'block';
        }
        else{
            errorPrice1.style.display = 'none';
            
        }
        
        if(optionPrice.value < 0 || optionPrice.value > 100){
            errorPrice2.style.display = 'block';
        }
        else{
            errorPrice2.style.display = 'none';
        }

        
        if(categorie.value == '?'){
            errorCategorie.style.display = 'block';
        }
        else{
            errorCategorie.style.display = 'none';
        }
        
        if(formTva.value == '?'){
            errorTva.style.display = 'block';
        }
        else{
            errorTva.style.display = 'none';
        }
    });
    
    


  
    form.addEventListener('submit', (event) => {

        
        if(optionName.value.length < 3 || optionName.value.length > 50){
            event.preventDefault();
        }
        
        
        if(optionShortName.value.length < 1 || optionShortName.value.length > 10){
            event.preventDefault();
        }
        
        if(isNaN(optionPrice.value)){
            event.preventDefault();
        }
        
        if(optionPrice.value < 0 || optionPrice.value > 100){
            event.preventDefault();
        }
        
        if(categorie.value == '?'){
            event.preventDefault();
            
        }
        
        if(formTva.value == '?'){
            event.preventDefault();
        }
        
    });
    

    
});