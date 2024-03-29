// Formulaires
import { formArticles } from './form/formArticles.js';
import { formOptions } from './form/formOptions.js';
import { formTVA } from './form/formTVA.js';
import { formPM } from './form/formPM.js';
import { formUpdateCustomer } from './form/formUpdateCustomer.js';
import { formAddCustomer } from './form/formAddCustomer.js';
import { formAddAdress } from './form/formAddAdress.js';

// Fonctions autres
import { deleteValidation } from './modules/deleteValidation.js';
import { ajaxArticle } from './modules/ajaxArticle.js';
import { ajaxOption } from './modules/ajaxOption.js';
import { validZipcode } from './modules/validZipcode.js';

window.addEventListener("DOMContentLoaded", function(){  

    // Formulaires
    if (window.location.toString().includes("addArticle")) {
        console.log("route1");
        formArticles();
    }

    if (window.location.toString().includes("updateArticles")) {
        console.log("route11");
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

    if (window.location.toString().includes("updateCustomer")) {
        console.log("route5");
        formUpdateCustomer();
    }

    if (window.location.toString().includes("addCustomer")) {
        console.log("route6");
        formAddCustomer();
    }

    if (window.location.toString().includes("addAdress")) {
        console.log("route7");
        formAddAdress();
        validZipcode();
    }

    // Fonctions autres
    if (window.location.toString().includes("displayOneCustomer")) {
        console.log("route8");
        deleteValidation();
    }

    if (window.location.toString().includes("articleGestion")) {
        console.log("route9");
        ajaxArticle();
    }

    if (window.location.toString().includes("articleOption")) {
        console.log("route10");
        ajaxOption();
    }
});