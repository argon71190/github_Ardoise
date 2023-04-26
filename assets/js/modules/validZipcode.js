
function validZipcode() {

    let inputZipcode = document.getElementById('zipcode');
    inputZipcode.addEventListener("change", function(){
        if(inputZipcode.value.length == 5){

            //préparation de la requete pour chercher la commune en fonction de la saisi
            let url = "https://geo.api.gouv.fr/communes?codePostal="+ inputZipcode.value;
            // déclaration d'une varibale ciblant la balise select pour y insérer les communes
            let insercity = document.getElementById("city");
            // Création de l'expression régulière pour la validation du code postal
            let postalCodeRegExp = new RegExp("^([0-9]){5}$", "g");
            // Récupération de la balise Small
            let small = form.zipcode.nextElementSibling;
            // Teste de l'expression régulière
            let testPostalCode = postalCodeRegExp.test(inputZipcode.value);
            // variable déclarer pour modifier la ou les balises option
            let actionOption = document.querySelectorAll("#city option");
            // variable déclarer pour créer une ou des balises option
            let option;
            // condition si l'api retourne un ou plusieurs données et si le code postal est valide
            if(testPostalCode)
            {
                /* appel de la requete avec la méthode fetch et traitement de la promesse en json
                qui sera reinterprété dans une autre promesse et appliqué */
                fetch(url).then(response => response.json()).then((datas) =>{
                    if(datas.length)
                    {
                        small.innerHTML = "";
                        form.zipcode.classList.remove("error");
                        form.zipcode.classList.add("valide");
                        //appel de la fonction pour supprimmer les anciennes valeurs si il y en a
                        removeElements(actionOption);
                        // attribution des valeurs retourné par l'api dans la balise option
                        for( let data of datas)
                        {
                            // création de la balise option
                            option = document.createElement("option");
                            // insertion de text dans la balise option
                            option.text = data.nom;
                            // insertion de valeur dans la balise option
                            option.value = data.nom;
                            // insertion de ou des balises options dans la balise select
                            insercity.appendChild(option);
                        }
                    }
                    // condition si l'api ne retourne pas de données et si le code postal n'est pas valide
                })
                .catch
                (Error => {
                    console.log(Error);
                    //appel de la fonction pour supprimmer les anciennes valeurs si il y en a
                    removeElements(actionOption);
                });
            }
            else
            {
                //appel de la fonction pour supprimmer les anciennes valeurs si il y en a
                // removeElements(actionOption);
                small.innerHTML = "Code postal n'est pas valide";
                form.zipcode.classList.remove("valide");
                form.zipcode.classList.add("error");
            }
        }
    });
}

export { validZipcode };