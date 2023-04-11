"use strict";

window.addEventListener('DOMContentLoaded', () => {
    
    // Formulaire
    let form = document.querySelector('.form');

    // Formulaire des options
    let formName = document.querySelector('.formName');
    let formShortName = document.querySelector('.formShortName');
    let formPrice = document.querySelector('.formPrice');
    let formCategorie = document.querySelector('.formCategorie');
    
    // Formulaire des articles
    let formTvap = document.querySelector('.formTvap');
    let formTvae = document.querySelector('.formTvae');
    let screen = document.querySelector('.screen');
    
    // Erreurs des options
    let errorName = document.querySelector('.errorName');
    let errorShortName = document.querySelector('.errorShortName');
    let errorPrice1 = document.querySelector('.errorPrice1');
    let errorPrice2 = document.querySelector('.errorPrice2');
    let errorCategorie = document.querySelector('.errorCategorie');
    
    // Erreurs des articles
    let errorTvaP = document.querySelector('.errorTvap');
    let errorTvaE = document.querySelector('.errorTvae');
    let errorScreen = document.querySelector('.errorScreen');

    form.addEventListener('submit', (event) => {

        //Ne pas submit si erreur nom
        if(formName.value.length < 3 || formName.value.length > 50){
            errorName.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorName.style.display = 'none';
        }
        
        //Ne pas submit si erreur nom court
        if(formShortName.value.length < 1 || formShortName.value.length > 10){
            errorShortName.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorShortName.style.display = 'none';
        }
        
        //Ne pas submit si erreurs prix
        if(isNaN(formPrice.value)){
            errorPrice1.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorPrice1.style.display = 'none';
        }
        
        if(formPrice.value < 0 || formPrice.value > 100){
            errorPrice2.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorPrice2.style.display = 'none';
        }
        
        //Ne pas submit si erreur catégorie
        if(formCategorie.value == '?'){
            errorCategorie.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorCategorie.style.display = 'none';
        }
        
        //Ne pas submit si erreurs TVA
        if(formTvap.value == '?'){
            errorTvaP.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorTvaP.style.display = 'none';
        }

        if(formTvae.value == '?'){
            errorTvaE.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorTvaE.style.display = 'none';
        }
        
        //Ne pas submit si erreur écran affichage
        if(screen.value == '?'){
            errorScreen.style.display = 'block';
            event.preventDefault();
        }
        else{
            errorScreen.style.display = 'none';
        }
    });
});

    
