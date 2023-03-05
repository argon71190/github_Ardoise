<?php

namespace Models;
use DateTime;

class ResultsManager {

        public function dateNow(string $format = 'Y-m-d H:i:s', string $fuseau = 'Europe/Paris') {
            date_default_timezone_set($fuseau);
            $dateActuelle = date_create('now')->format($format);
            return $dateActuelle;
        }

        public function genererChaineAleatoire($longueur = 10) {
            return substr(str_shuffle(str_repeat($code='0123456789ABCDEFGHJKLMNPQRSTVWXYZacefhjkmnrstvwxyz', ceil($longueur/strlen($code)) )),1,$longueur);
        }

        public function validateDate($date, $format = 'Y-m-d H:i:s') {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }
}