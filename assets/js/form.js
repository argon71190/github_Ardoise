import { formArticles } from './formArticles.js';
import { formOptions } from './formOptions.js';
import { formTVA } from './formTva.js';
import { formPM } from './formPM.js';


window.addEventListener("DOMContentLoaded", function(){  

    if (window.location.toString().includes("addArticle")) {
        console.log("route1");
        formArticles();
    }

    if (window.location.toString().includes("addOption")) {
        console.log("route2");
        formOptions();
    }

    if (window.location.toString().includes("addTva")) {
        console.log("route3");
        formTVA();
    }

    if (window.location.toString().includes("addPaymentMethod")) {
        console.log("route4");
        formPM();
    }

});