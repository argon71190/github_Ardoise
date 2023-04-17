import { formArticles } from './form/formArticles.js';
import { formOptions } from './form/formOptions.js';
import { formTVA } from './form/formTVA.js';
import { formPM } from './form/formPM.js';
import { formUpdateCustomer } from './form/formUpdateCustomer.js';
import { formAddCustomer } from './form/formAddCustomer.js';

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

    if (window.location.toString().includes("updateCustomer")) {
        console.log("route5");
        formUpdateCustomer();
    }

    if (window.location.toString().includes("addCustomer")) {
        console.log("route6");
        formAddCustomer();
    }
});