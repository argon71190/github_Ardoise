function ajaxOption(){
    let categorieOption = document.getElementById('categorieOption');
    

    categorieOption.addEventListener('change', function(){
        let value = document.getElementById('categorieOption').value;
        let article = document.getElementById('articleId').value;

        let myRequest = new Request("index.php?route=searchOptionAjax&id="+article, {
            
            method: "POST",
            body: JSON.stringify({category:value})
        })

    
    fetch(myRequest)
                // Récupère les données
                .then(res => res.text())

                // Exploite les données
                .then(res => {
                    document.getElementById("targets").innerHTML = res; 
                    // On met articles.phtml dans la div -> id=target
                    // ou
                    // location.reload(); // Pour une réactualisation de la page
                    let label = document.querySelectorAll('label');
                    let input = document.querySelectorAll('.input');
                    
                })
                

    })
    
    
} 

export { ajaxOption };