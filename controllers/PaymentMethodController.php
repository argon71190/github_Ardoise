<?php

namespace Controllers;

use \App\Router;
use \Models\ArticlesManager;
use \Models\ResultsManager;
use \Models\ErrorMessages;
use \Models\ValidMessages;
use \Models\CategoriesManager;
use \Models\Categories;
use \Models\Tva;
use \Models\TvaManager;
use \Models\PaymentMethod;
use \Models\PaymentMethodManager;

class PaymentMethodController extends Router
{
    public function addOnePaymentMethod() {

        $errors = [];
        $valids = [];
        $paymentMethod = ['name' => ''];

        if(isset($_POST) && empty($_POST)){
            $model            = new PaymentMethodManager();
            $paymentMethod    = $model->getAllPaymentMethod();

            for($i=0; $i < count($paymentMethod); $i++) {
                $model = new ResultsManager();
                $_SESSION['tokenGestionTva'][$i] = [
                    'token' => $model->genererChaineAleatoire(20),
                    'id'    => $paymentMethod[$i]['id']
                ];
            }

            $model = new ResultsManager();
            $token = $model->genererChaineAleatoire(20);
            $_SESSION['tokenVerify'] = $token;

            $this->render(
                'gestionPaymentMethod',
                'layout',
                [
                    'paymentMethod' => $paymentMethod,
                    'token'         => $token
                ]
            );
        }
        else{
            $addPM = [ 'name' => trim(strtoupper($_POST['name']))];

            // Récupération de la liste des messages d'erreur
            $errorsList = new ErrorMessages();
            $messagesErrors = $errorsList->getMessages();

            // Vérification si le formulaire provient bien de notre site
            if(isset($_SESSION['tokenVerify']) && $_SESSION['tokenVerify'] != $_POST['token']){
                $errors[] = $messagesErrors[0];
            }

            // Vérification du champ Name du moyen de paiement
            if(strlen($addPM['name']) < 2 || strlen($addPM['name']) > 20){
                $errors[] = $messagesErrors[53];
            }

            // Vérifier si la catégorie n'existe pas déjà dans la bdd pour éviter les doublons
            $model = new PaymentMethodManager();
            $verifExistPM = $model->selectOne($addPM['name']);
            if(!empty($verifExistPM)){
                $errors[] = $messagesErrors[51];
            }

            if(count($errors) == 0) {
                // Aucune erreur, on peut maintenant ajouter la nouvelle catégorie dans la bdd
                $name         = $addPM['name'];

                $addPM = new PaymentMethod();
                $addPM->setName($name);

                // Récupération de la liste des messages de validation
                $validsList = new ValidMessages();
                $messagesValids = $validsList->getMessages();

                // Insertion dans la bdd
                $manager = new PaymentMethodManager();
                $manager->insert($addPM);

                // Ajout d'un message de validation
                $valids[] = $messagesValids[7];

                $model      = new PaymentMethodManager();
                $PM = $model->getAllPaymentMethod();

                // Régénération des tokens pour chaque formulaire de suppression de la catégorie
                for($i=0; $i < count($PM); $i++) {
                    $model = new ResultsManager();
                    $_SESSION['tokenGestionTva'][$i] = [
                        'token' => $model->genererChaineAleatoire(20),
                        'id'    => $PM[$i]['id']
                    ];
                }

                $model = new ResultsManager();
                $token = $model->genererChaineAleatoire(20);
                $_SESSION['tokenVerify'] = $token;

                $this->render(
                    'gestionPaymentMethod',
                    'layout',
                    [
                        'addPaymentMethod'  => $addPM,
                        'token'             => $token,
                        'valids'            => $valids,
                        'paymentMethod'     => $PM
                    ]
                );
            }
            else{
                $model      = new PaymentMethodManager();
                $PM = $model->getAllPaymentMethod();

                // Régénération des tokens pour chaque formulaire de suppression de la catégorie
                for($i=0; $i < count($PM); $i++) {
                    $model = new ResultsManager();
                    $_SESSION['tokenGestionTva'][$i] = [
                        'token' => $model->genererChaineAleatoire(20),
                        'id'    => $PM[$i]['id']
                    ];
                }

                $model = new ResultsManager();
                $token = $model->genererChaineAleatoire(20);
                $_SESSION['tokenVerify'] = $token;

                $this->render(
                    'gestionPaymentMethod',
                    'layout',
                    [
                        'addPaymentMethod'  => $addPM,
                        'token'             => $token,
                        'errors'            => $errors,
                        'paymentMethod'     => $PM
                    ]
                );
            }
        }
    }

    public function activationPaymentMethod() {
        $errors = [];

        $model      = new PaymentMethodManager();
        $allPM = $model->getAllPaymentMethod();
        $PMInDb;
        foreach($allPM as $PM) {
            if($PM['id'] == $_GET['id'])
                $PMInDb = $PM;
        }

        // Récupération de la liste des messages d'erreur
        $errorsList = new errorMessages();
        $messagesErrors = $errorsList->getMessages();

        if(!$PMInDb)
                $errors[] = $messagesErrors[54];

        if(count($errors) == 0) {

            if($PMInDb['activate'] == 0) $newRef = 1; else $newRef = 0;

            $activatePM = new Tva();
            $activatePM->setId($PMInDb['id']);
            $activatePM->setActivate($newRef);

            // Modification de l'état de la catégorie
            $manager = new PaymentMethodManager();
            $manager->update($activatePM);

            $model = new ResultsManager();
            $token = $model->genererChaineAleatoire(20);
            $_SESSION['tokenVerify'] = $token;

            $model      = new PaymentMethodManager();
            $allPM = $model->getAllPaymentMethod();

            // Régénération des tokens pour chaque formulaire de suppression de la TVA
            for($i=0; $i < count($allPM); $i++) {
                $model = new ResultsManager();
                $_SESSION['tokenGestionCategories'][$i] = [
                    'token' => $model->genererChaineAleatoire(20),
                    'id'    => $allPM[$i]['id']
                ];
            }

            $this->render(  'gestionPaymentMethod',
                            'layout',
                            [
                                'addPaymentMethod'  => [],
                                'token'             => $token,
                                'paymentMethod'     => $allPM
                            ]);
        }
    }
    
}