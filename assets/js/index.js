import { deleteValidation } from './modules/deleteValidation.js';

window.addEventListener("DOMContentLoaded", function(){  

    if (window.location.toString().includes("displayOneCustomer")) {
        console.log("route1");
        deleteValidation();
    }

});