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
    let formTvap = document.querySelector('.formTvap');
    let formTvae = document.querySelector('.formTvae');
    let screen = document.querySelector('.screen');
    
    //Erreurs
    let errorName = document.querySelector('.errorName');
    let errorShortName = document.querySelector('.errorShortName');
    let errorPrice1 = document.querySelector('.errorPrice1');
    let errorPrice2 = document.querySelector('.errorPrice2');
    let errorCategorie = document.querySelector('.errorCategorie');
    
    //Article erreurs

    let errorTvaP = document.querySelector('.errorTvap');
    let errorTvaE = document.querySelector('.errorTvae');
    let errorScreen = document.querySelector('.errorScreen');


    optionSubmit.addEventListener('click', (event)=> {
        //Affichage erreur nom
        if(optionName.value.length < 3 || optionName.value.length > 50){
            errorName.style.display = 'block';
        }
        else{
            errorName.style.display = 'none';
        }
        
        //Affichage erreur nom court
        if(optionShortName.value.length < 1 || optionShortName.value.length > 10){
            errorShortName.style.display = 'block';
            
        }
        else{
            errorShortName.style.display = 'none';
        }

        //Affichage erreurs prix
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

        //Affichage erreur catégorie
        if(categorie.value == '?'){
            errorCategorie.style.display = 'block';
        }
        else{
            errorCategorie.style.display = 'none';
        }

        //Affichage erreurs TVA
        if(formTvap.value == '?'){
            errorTvaP.style.display = 'block';
        }
        else{
            errorTvaP.style.display = 'none';
        }

        if(formTvae.value == '?'){
            errorTvaE.style.display = 'block';
        }
        else{
            errorTvaE.style.display = 'none';
        }

        //Affichage erreur écran d'affichage
        if(screen.value == '?'){
            errorScreen.style.display = 'block';
        }
        else{
            errorScreen.style.display = 'none';
        }
    });
    
    


  
    form.addEventListener('submit', (event) => {

        //Ne pas submit si erreur nom
        if(optionName.value.length < 3 || optionName.value.length > 50){
            event.preventDefault();
        }
        
        //Ne pas submit si erreur nom court
        if(optionShortName.value.length < 1 || optionShortName.value.length > 10){
            event.preventDefault();
        }
        
        //Ne pas submit si erreurs prix
        if(isNaN(optionPrice.value)){
            event.preventDefault();
        }
        
        if(optionPrice.value < 0 || optionPrice.value > 100){
            event.preventDefault();
        }
        
        //Ne pas submit si erreur catégorie
        if(categorie.value == '?'){
            event.preventDefault();
            
        }
        
        //Ne pas submit si erreurs TVA
        if(formTvap.value == '?'){
            event.preventDefault();
        }

        if(formTvae.value == '?'){
            event.preventDefault();
        }
        
        //Ne pas submit si erreur écran affichage
        if(errorScreen.value == '?'){
            event.preventDefault();
        }
    });
    

    
});