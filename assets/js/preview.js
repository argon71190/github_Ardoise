'use strict';

function handleFiles(files) {
    let imageType = /^image\//;
    for (let i = 0; i < files.length; i++) {
        let file = files[i];
        if (!imageType.test(file.type)) {
            alert("Veuillez sélectionner une image");
    }else{
        if(i == 0){
            preview.innerHTML = '';
        }


        let retraitClass = document.querySelector("#divImage");
        retraitClass.classList.remove("displayNone");

        let img = document.createElement("img");
        img.classList.add("img_preview");
        img.file = file;
        preview.appendChild(img);
        let reader = new FileReader();
        reader.onload = ( function(aImg) {
            return function(e) {
                aImg.src = e.target.result;
            };
        })(img);

        reader.readAsDataURL(file);
        }
    }
}



