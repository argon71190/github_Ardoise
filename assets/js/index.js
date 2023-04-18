import { deleteValidation } from './modules/deleteValidation.js';
import { ajaxArticle } from './modules/ajaxArticle.js';
import { ajaxOption } from './modules/ajaxOption.js';

window.addEventListener("DOMContentLoaded", function(){  

    if (window.location.toString().includes("displayOneCustomer")) {
        console.log("route1");
        deleteValidation();
    }

    if (window.location.toString().includes("articleGestion")) {
        console.log("route2");
        ajaxArticle();
    }

    if (window.location.toString().includes("articleOption")) {
        console.log("route3");
        ajaxOption();
    }
});