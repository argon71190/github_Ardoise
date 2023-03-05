'use strict';

if(document.querySelector(".ecransList") != null) {
    let ecran = document.querySelector(".ecransList");
    ecran.addEventListener('change', changeEcran);

    function changeEcran(event) {
        //event.preventDefault();
        let value = document.querySelector('.ecransList').value;

        if(value.length != 0){

            let req1 = new Request('index.php?route=search', {
                method: 'POST',
                body: JSON.stringify({val : value})
            })

            fetch(req1)
                //.then(result => result.text())
                .then(result => {

                    let imgStandBy = document.querySelector('#imgStandBy');
                    imgStandBy.style.display = "block";

                    let divImgStandBy = document.querySelector('.dispositionCommandes');
                    imgStandBy.style.src = "original.gif";

                    console.log(divImgStandBy.offsetWidth);
                    console.log(divImgStandBy.offsetHeight);

                    imgStandBy.style.left = divImgStandBy.offsetWidth/2 - 260 + "px";
                    imgStandBy.style.top = divImgStandBy.offsetHeight/2 - 170 + "px";

                    window.setTimeout(function() {
                        location.reload(true);
                    }, 3000);
            });
        }
    }

    let element = document.querySelectorAll(".flashing");
    let signe = 1;
    let i = 1;
    let opacityElement=1

    window.setInterval(opacity, 15);

    function opacity() {
        let e = 0;
        for (e; e < element.length; e++) {
            element[e].style.opacity = (element[e].style.opacity * 1) + (signe * 0.03);
            opacityElement = (element[e].style.opacity * 1) + (signe * 0.03);
            // element[e].style.color = "red";
            // element[e].style.fontWeight = "bold";
        }

        if(opacityElement >= 1) { signe = -1; }
        if(opacityElement <= 0) { signe = 1; }
    }

    let a = 0;
    let options = document.querySelectorAll(".img_option");
    for (a; a < options.length; a++) {
        options[a].addEventListener('click', statutButton);
    }

    function statutButton(event) {
        event.preventDefault();
        this.classList.toggle("desactivate");
        if(this.classList.contains('desactivate')) {
            document.querySelector("."+this.id).value = "";
        } else {
            document.querySelector("."+this.id).value = this.className.replace("img_option ", "");
        }
        actualisationOptions();
    }

    function actualisationOptions(event) {
        let a = 0;
        let val = "";
        let options = document.querySelectorAll(".SAUCES");

        for (a; a < options.length; a++) {
            val += options[a].value + " ";
        }

        document.querySelector("#SAUCES").value = "[" + document.querySelector(".elem_5").value + "]";
        console.log('changement');
    }


    // let date1 = new Date('2012-07-20 00:00:00');
    // let date2 = Date.now();
    // let tmp = date2 - date1
    // console.log(tmp);
    // La variable tmp contient un entier, qui correspond au nombre de millisecondes entres les 2 dates.
    //Ensuite il ne reste plus qu'à utiliser les divisions et le modulo pour en extraire le nombre de secondes, minutes, heures et jours (1 jour = 24 heures, 1 heure = 60 minutes, 1 minute = 60 secondes) :

    function dateDiff(date1, date2){
        var diff = {}							// Initialisation du retour
        var tmp = date2 - date1;

        tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
        diff.sec = tmp % 60;					// Extraction du nombre de secondes

        tmp = Math.floor((tmp-diff.sec)/60);	// Nombre de minutes (partie entière)
        diff.min = tmp % 60;					// Extraction du nombre de minutes

        tmp = Math.floor((tmp-diff.min)/60);	// Nombre d'heures (entières)
        diff.hour = tmp % 24;					// Extraction du nombre d'heures

        tmp = Math.floor((tmp-diff.hour)/24);	// Nombre de jours restants
        diff.day = tmp;

        return diff;
    }


    let intervalID = window.setInterval(updateTimer, 1000);

    function updateTimer() {
        let times = document.querySelectorAll(".time");

        let dateN = new Date;
        let hours = dateN.getHours();
            if(hours<10) { hours = '0'+ hours; }
        let minutes = dateN.getMinutes();
            if(minutes<10) { minutes = '0'+ minutes; }
        document.querySelector("#clock").innerHTML = '<i class="fa-regular fa-clock"></i>' + hours + ":" + minutes;

        let dateNow = Date.now();
        for(let i=0; i < times.length; i++) {
            let id = times[i].id.replace('time_', '');
            let elementDate = new Date(times[i].value);
            let diff = dateDiff(elementDate, dateNow);

            let hour = diff['hour'];
            if(diff['hour']<10) { hour = '0'+ diff['hour']; }
            let min = diff['min'];
            if(diff['min']<10) { min = '0'+ diff['min']; }
            let sec = diff['sec'];
            if(diff['sec']<10) { sec = '0'+ diff['sec']; }

            document.querySelector("#result_"+id).innerHTML = hour+":"+min+":"+sec;
            let verif = parseInt(diff['hour']*60) + parseInt(diff['min']);

            if(verif < 30) {
                document.querySelector("#result_"+id).style.color = "#1ABC9C";
            } else if(verif >= 30 && verif < 60) {
                document.querySelector("#result_"+id).style.color = "#E67E22";
            } else {
                document.querySelector("#result_"+id).style.color = "#E74C3C";
            }
        }
    }
}

