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

class TvaController extends Router
{
    public function addOneTva() {

        $errors = [];
        $valids = [];
        $addTva = ['name' => '', 'value' => ''];

        if(isset($_POST) && empty($_POST)){
            $model  = new TvaManager();
            $tva    = $model->getAllTva();

            for($i=0; $i < count($tva); $i++) {
                $model = new ResultsManager();
                $_SESSION['tokenGestionTva'][$i] = [
                    'token' => $model->genererChaineAleatoire(20),
                    'id'    => $tva[$i]['id']
                ];
            }

            $model = new ResultsManager();
            $token = $model->genererChaineAleatoire(20);
            $_SESSION['tokenVerify'] = $token;

            $this->render(
                'gestionTVA',
                'layout',
                [
                    'tva'   => $tva,
                    'token' => $token
                ]
            );
        }
        else{
            $addTva = [ 'name' => trim($_POST['tvaValue'])."%",
                        'value' => trim($_POST['tvaValue'])
                        ];
            // Récupération de la liste des messages d'erreur
            $errorsList = new ErrorMessages();
            $messagesErrors = $errorsList->getMessages();

            // Vérification si le formulaire provient bien de notre site
            if(isset($_SESSION['tokenVerify']) && $_SESSION['tokenVerify'] != $_POST['token']){
                $errors[] = $messagesErrors[0];
            }

            // Vérification du champ Value de la TVA
            if($addTva['value'] < 0 || $addTva['value'] > 100){
                $errors[] = $messagesErrors[50];
            }

            // Vérification du champ Value de la TVA
            if(!is_numeric($addTva['value'])){
                $errors[] = $messagesErrors[50];
            }


            // Vérifier si la catégorie n'existe pas déjà dans la bdd pour éviter les doublons
            $model = new TvaManager();
            $verifExistTva = $model->selectOne($addTva['name']);
            if(!empty($verifExistTva)){
                $errors[] = $messagesErrors[51];
            }

            if(count($errors) == 0) {
                // Aucune erreur, on peut maintenant ajouter la nouvelle catégorie dans la bdd
                $name         = $addTva['name'];
                $value         = $addTva['value'];

                $addTva = new Tva();
                $addTva->setName($name);
                $addTva->setValue($value);

                // Récupération de la liste des messages de validation
                $validsList = new ValidMessages();
                $messagesValids = $validsList->getMessages();

                // Insertion dans la bdd
                $manager = new TvaManager();
                $manager->insert($addTva);

                // Ajout d'un message de validation
                $valids[] = $messagesValids[7];

                $model      = new TvaManager();
                $tva = $model->getAllTva();

                // Régénération des tokens pour chaque formulaire de suppression de la catégorie
                for($i=0; $i < count($tva); $i++) {
                    $model = new ResultsManager();
                    $_SESSION['tokenGestionTva'][$i] = [
                        'token' => $model->genererChaineAleatoire(20),
                        'id'    => $tva[$i]['id']
                    ];
                }

                $model = new ResultsManager();
                $token = $model->genererChaineAleatoire(20);
                $_SESSION['tokenVerify'] = $token;

                $this->render(
                    'gestionTVA',
                    'layout',
                    [
                        'addTva'    => $addTva,
                        'token'     => $token,
                        'valids'    => $valids,
                        'tva'       => $tva
                    ]
                );
            }
            else{
                $model      = new TvaManager();
                $tva = $model->getAllTva();

                // Régénération des tokens pour chaque formulaire de suppression de la catégorie
                for($i=0; $i < count($tva); $i++) {
                    $model = new ResultsManager();
                    $_SESSION['tokenGestionTva'][$i] = [
                        'token' => $model->genererChaineAleatoire(20),
                        'id'    => $tva[$i]['id']
                    ];
                }

                $model = new ResultsManager();
                $token = $model->genererChaineAleatoire(20);
                $_SESSION['tokenVerify'] = $token;

                $this->render(
                    'gestionTVA',
                    'layout',
                    [
                        'addTva'    => $addTva,
                        'token'     => $token,
                        'errors'    => $errors,
                        'tva'       => $tva
                    ]
                );
            }
        }
    }

    public function activationTva() {
        $errors = [];

        $model      = new TvaManager();
        $allTva = $model->getAllTva();
        $tvaInDb;
        foreach($allTva as $tva) {
            if($tva['id'] == $_GET['id'])
                $tvaInDb = $tva;
        }

        // Récupération de la liste des messages d'erreur
        $errorsList = new errorMessages();
        $messagesErrors = $errorsList->getMessages();

        if(!$tvaInDb)
                $errors[] = $messagesErrors[52];

        if(count($errors) == 0) {

            if($tvaInDb['activate'] == 0) $newRef = 1; else $newRef = 0;

            $activateTva = new Tva();
            $activateTva->setId($tvaInDb['id']);
            $activateTva->setActivate($newRef);

            // Modification de l'état de la catégorie
            $manager = new TvaManager();
            $manager->update($activateTva);

            $model = new ResultsManager();
            $token = $model->genererChaineAleatoire(20);
            $_SESSION['tokenVerify'] = $token;

            $model      = new TvaManager();
            $allTva = $model->getAllTva();

            // Régénération des tokens pour chaque formulaire de suppression de la TVA
            for($i=0; $i < count($allTva); $i++) {
                $model = new ResultsManager();
                $_SESSION['tokenGestionCategories'][$i] = [
                    'token' => $model->genererChaineAleatoire(20),
                    'id'    => $allTva[$i]['id']
                ];
            }
            
            $this->render(  'gestionTVA',
                            'layout',
                            [
                                'addTva'    => [],
                                'token'     => $token,
                                'tva'       => $allTva
                            ]);
        }
    }

}