"use strict";
console.log('ok');
window.addEventListener('DOMContentLoaded', () => {
    let categorieArticle = document.getElementById('categorieArticle');


    categorieArticle.addEventListener('change', function(){
        let value = document.getElementById('categorieArticle').value;
        let myRequest = new Request("index.php?route=searchArticleAjax", {
            
            method: "POST",
            body: JSON.stringify({category:value})
        })

    
    fetch(myRequest)
                // Récupère les données
                .then(ress => res.text())

                // Exploite les données
                .then(res => {
                    document.getElementById("target").innerHTML = res; 
                    // On met articles.phtml dans la div -> id=target
                    // ou
                    // location.reload(); // Pour une réactualisation de la page
                })
    })
});    