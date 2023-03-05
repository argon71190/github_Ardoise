<?php

namespace Models;

class ValidMessages {

    public function getMessages() {
        // Tableau des messages de validation possibles à l'affichage.
        $messagesValids = [
            /*   0 */ "Votre demande a bien été enregistrée.",
            /*   1 */ "Un E-mail vient de vous être envoyé avec vos mouveaux identifiants.",
            /*   2 */ "Votre demande de création de compte a bien été enregistrée.",
            /*   3 */ "L'article <i>(et son code barre)</i> ont bien été créés !",
            /*   4 */ "Il apparaîtra dans la liste des articles selon son état d'activation !",
            /*   5 */ "La nouvelle catégorie a bien été créé !",
            /*   6 */ "La catégorie a bien été supprimée !",
        ];

        return $messagesValids;
    }
}