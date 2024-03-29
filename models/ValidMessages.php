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
            /*   7 */ "La nouvelle catégorie a bien été créé !",
            /*   8 */ "L'option a bien été créée !",
            /*   9 */ "Votre compte a bien été modifié.",
            /*   10 */ "Votre compte a bien été activé.",
            /*   11 */ "Votre compte a bien été désactivé.",
            /*   12 */ "Votre compte a bien été supprimé.",
            /*   13 */ "Votre adresse a bien été enregistrée.",
            /*   14 */ "L'option a bien été liée !",
            /*   15 */ "L'option a bien été supprimée !",
            /*   16 */ "L'article a bien été mis à jour !",
        ];

        return $messagesValids;
    }
}