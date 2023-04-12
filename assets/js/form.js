import { formArticles } from './formArticles.js';
import { formOptions } from './formOptions.js';




window.addEventListener("DOMContentLoaded", function(){  

    if (window.location.toString().includes("addArticle")) {
        console.log("route1");
        formArticles();
    }

    if (window.location.toString().includes("addOption")) {
        console.log("route2");
        formOptions();
    }


});