<?php

namespace Models;

class errorMessages {

    public function getMessages(): array {
        // Tableau des messages d'erreurs possibles à l'affichage.
        $messagesErrors = [
            /*   0 */ "Une erreur est survenue lors de l'envoi du formulaire !",
            /*   1 */ "Votre nom doit comporter au moins 2 caractères !",
            /*   2 */ "Votre prénom doit comporter au moins 2 caractères !",
            /*   3 */ "Veuillez renseigner votre date de naissance !",
            /*   4 */ "Votre date de naissance ne peut être supérieure ou égale à la date actuelle !",
            /*   5 */ "Vous devez être majeur (+18ans) pour vous inscrire !",
            /*   6 */ 'Veuillez renseigner un email valide SVP !',
            /*   7 */ "Veuillez renseigner votre mot de passe !",
            /*   8 */ "Vous n'avez pas confirmé correctement votre mot de passe !",
            /*   9 */ "→ Minimum 8 caractères !",
            /*  10 */ "→ Le mot de passe doit inclure au moins une lettre majuscule !",
            /*  11 */ "→ Le mot de passe doit inclure au moins une lettre minuscule !",
            /*  12 */ "→ Le mot de passe doit inclure au moins un chiffre !",
            /*  13 */ "→ Le mot de passe doit inclure au moins un caractère spécial !",
            /*  14 */ "Le RFID doit contenir 10 chiffres !",
            /*  15 */ "Le RFID ne doit contenir que des chiffres !",
            /*  16 */ "Cette adresse email existe déjà !",
            /*  17 */ "Votre nom ne doit contenir que des lettres !",
            /*  18 */ "Votre prénom ne doit contenir que des lettres !",
            /*  19 */ "Le fichier n'a pas été enregistré correctement",
            /*  20 */ "Un problème est survenu avec le fichier uploadé !",
            /*  21 */ "Ce type de fichier n'est pas autorisé !",
            /*  22 */ "Le fichier est trop volumineux",
            /*  23 */ "Une erreur a eu lieu au moment de l'upload",
            /*  24 */ "Le nom de l'article doit comporter entre 3 et 50 caractères !",
            /*  25 */ "Le nom court de l'article doit comporter entre 3 et 20 caractères !",
            /*  26 */ "Le prix de l'article, exprimé en €, doit être un nombre entier ou avec 2 décimales maximum !",
            /*  27 */ "Veuillez sélectionner une catégorie pour l'article !",
            /*  28 */ "La catégorie de l'article n'existe pas, veuillez sélectionner une catégorie dans la liste proposée !",
            /*  29 */ "Veuillez sélectionner une TVA <u>sur place</u> pour l'article !",
            /*  30 */ "La TVA <u>sur place</u> de l'article n'existe pas, veuillez sélectionner une TVA dans la liste proposée !",
            /*  31 */ "Veuillez sélectionner une TVA <u>à emporter</u> pour l'article !",
            /*  32 */ "La TVA <u>à emporter</u> de l'article n'existe pas, veuillez sélectionner une TVA dans la liste proposée !",
            /*  33 */ "Veuillez renseigner le champ <u>Activation</u> pour l'article !",
            /*  34 */ "Veuillez renseigner le champ <u>Ecran d'affichage</u> pour l'article !",
            /*  35 */ "L'écran d'affichage sélectionné n'existe pas, veuillez sélectionner un écran dans la liste proposée !",
            /*  36 */ "Veuillez renseigner correctement le champ <u>Code barre</u> avec 13 chiffres !",
            /*  37 */ "Le champ <u>Code barre</u> ne doit contenir que des chiffres !",
            /*  38 */ "Le code barre renseigné existe déjà !",
            /*  39 */ "L'image chargée est trop grande ( 220px * 240px max ) !",
            /*  40 */ "Pensez à recharger l'image !",
            /*  41 */ "Cette catégorie existe déjà !",
            /*  42 */ "Le nom de la catégorie doit comporter entre 2 et 50 caractères !",
            /*  43 */ "Un problème est survenu lors de la modification de la catégorie !",
            /*  44 */ "Impossible de supprimer cette catégorie, <u><strong>",
            /*  45 */ " articles</strong></u> y sont encore affectés !",
            /*  46 */ "Tous ces articles doivent être affectés dans une autre catégorie pour pouvoir supprimer cette catégorie !",
            /*  47 */ "Un problème est survenu lors de la suppression !",
            /*  48 */ "Veuillez charger une image SVP !",
            

            
            /*  49 */ "Le champ Nom de la TVA doit comprendre entre 2 et 40 caractères",
            /*  50 */ "Le Taux de la TVA doit être un nombre compris entre 0 et 100",
            /*  51 */ "Ce taux existe déjà !",
            /*  52 */ "Un problème est survenu lors de la modification de la tva !",
            /*  53 */ "Le champ Moyen de paiement doit comprendre entre 2 et 20 caractères",
            /*  54 */ "Ce moyen de paiement existe déjà !",
            /*  55 */ "Un problème est survenu lors de la modification du moyen de paiement !",
            

            /*  56 */ "Le nom de l'option doit comporter entre 3 et 50 caractères !",
            /*  57 */ "Le nom court de l'option doit comporter entre 1 et 10 caractères !",
            /*  58 */ "Le prix de l'option, exprimé en €, doit être un nombre entier ou avec 2 décimales maximum !",
            /*  59 */ "Veuillez sélectionner une catégorie pour l'option !",
            /*  60 */ "La catégorie de l'option n'existe pas, veuillez sélectionner une catégorie dans la liste proposée !",
            /*  61 */ "Le prix de l'option doit être compris entre 1 centime et 100 € !",

            /*  62 */ "Votre adresse doit comprendre entre 2 et 100 caractères !",
            /*  63 */ "Votre adresse ne doit contenir que des lettres, des chiffres et les caractères spéciaux suivants (' .-) !",
            /*  64 */ "Le code postal doit comprendre 5 chiffres !",
            /*  65 */ "La ville doit comprendre entre 1 et 100 caractères !",
            /*  66 */ "La ville ne doit contenir que des lettres et les caractères spéciaux suivants (' .-) !",
            /*  67 */ "Merci de rentrer un pays de la liste !",

            /*  68 */ "Veuillez sélectionner une option à lier !",
            /*  69 */ "L'ID option envoyé n'existe pas !",
            /*  70 */ "L'ID article envoyé n'existe pas !",
            /*  71 */ "Une des options sélectionnées est déjà présente sur l'article !",


        ];

        return $messagesErrors;
    }



}
