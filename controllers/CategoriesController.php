<?php

namespace Controllers;

use \App\Router;
use \Models\ArticlesManager;
use \Models\ResultsManager;
use \Models\errorMessages;
use \Models\ValidMessages;
use \Models\CategoriesManager;
use \Models\Categories;

class CategoriesController extends Router
{
    public function displayCategories($view) {

        if($view == 'categories') {
            $model      = new CategoriesManager();
            $categories = $model->getCategories();
            $this->render(
                'categories',
                'layout',
                [
                    'categories' => $categories
                ]);
        } else {
            $model = new ResultsManager();
            $token = $model->genererChaineAleatoire(20);
            $_SESSION['tokenVerify'] = $token;

            $model      = new CategoriesManager();
            $categories = $model->getAllCategories();

            for($i=0; $i < count($categories); $i++) {
                $model = new ResultsManager();
                $_SESSION['tokenGestionCategories'][$i] = [
                    'token' => $model->genererChaineAleatoire(20),
                    'id'    => $categories[$i]['id']
                ];
            }

            $this->render(
                'gestionCategories',
                'layout',
                [
                    'categories' => $categories,
                    'token' => $token
                ]);
        }
    }


    public function displayAllProductsByCategory($id) {
        $model    = new ArticlesManager();
        $articles = $model->getAllArticlesByCat($id);
        $options = [];
        $i=0;
        foreach($articles as $art) {
            $model   = new ArticlesManager();
            $isOptions = $model->getAllOptionsOfArticle($art['id']);
            if(count($isOptions) == 0)
                $articles[$i]['options'] = false;
            else
                $articles[$i]['options'] = true;

            $i++;
        }
        //var_dump($articles);
        //var_dump($options);
        $this->render('articles', 'layout', ['articles' => $articles]);
    }


    public function addOneCategorie() {

        // $verif = new \Models\Verif_admin();
        // $verif->getVerifIfAdmin();

        $errors = [];
        $valids = [];

        $addCategorie = ['name' => '', 'picture' => ''];

        if(array_key_exists('name', $_POST) && array_key_exists('submit', $_POST)
            && array_key_exists('token', $_POST) && $_POST['submit'] == "Ajouter") {

            $addCategorie = [
                'name'      => trim(strtoupper($_POST['name'])),
                'picture'   => 'noPicture.png'
            ];

            // Récupération de la liste des messages d'erreur
            $errorsList = new errorMessages();
            $messagesErrors = $errorsList->getMessages();

            // Vérification si le formulaire provient bien de notre site
            if(isset($_SESSION['tokenVerify']) && $_SESSION['tokenVerify'] != $_POST['token'])
                $errors[] = $messagesErrors[0];

            // Vérification du champ "Nom de la catégorie"
            if(strlen($addCategorie['name']) < 2 || strlen($addCategorie['name']) > 50)
                $errors[] = $messagesErrors[42];

            if($_FILES['fileCategorie']['name'] == '') {
                $errors[] = $messagesErrors[48];
            }

            if(isset($_FILES['fileCategorie']) && $_FILES['fileCategorie']['name'] != '') {
                $size = getimagesize($_FILES['fileCategorie']['tmp_name']);
                if($size[0] > 220 || $size[1] > 240)
                    $errors[] = $messagesErrors[39];
            }

            if(count($errors) == 0) {
                // Vérifier si la catégorie n'existe pas déjà dans la bdd pour éviter les doublons
                $model              = new CategoriesManager();
                $verifExistCategorie = $model->selectOne($addCategorie['name']);

                if(!empty($verifExistCategorie))
                    $errors[] = $messagesErrors[41];

                if(count($errors) == 0) {
                    // On upload l'image si l'utilisateur en a chargé une dans le formulaire.
                    if(isset($_FILES['fileCategorie']) && $_FILES['fileCategorie']['name'] != '') {
                        $dossier = "categories/";
                        $model = new \Models\Uploads();
                        $addCategorie['picture'] = $model->uploadFile($_FILES['fileCategorie'], $errors, $dossier);
                    }
                }

                 // Si une image devait être uploadée et que l'upload s'est bien passé
                if(count($errors) == 0) {
                    // Aucune erreur, on peut maintenant ajouter la nouvelle catégorie dans la bdd
                    $name         = $addCategorie['name'];
                    $picture      = $addCategorie['picture'];

                    $addCategorie = new Categories();
                    $addCategorie->setName($name);
                    $addCategorie->setPicture($picture);
                    $addCategorie->setActivate(1);

                    // Récupération de la liste des messages de validation
                    $validsList = new ValidMessages();
                    $messagesValids = $validsList->getMessages();

                    // Insertion dans la bdd
                    $manager = new CategoriesManager();
                    $manager->insert($addCategorie);

                    // Ajout d'un message de validation
                    $valids[] = $messagesValids[5];

                    $model      = new CategoriesManager();
                    $categories = $model->getAllCategories();

                    // Régénération des tokens pour chaque formulaire de suppression de la catégorie
                    for($i=0; $i < count($categories); $i++) {
                        $model = new ResultsManager();
                        $_SESSION['tokenGestionCategories'][$i] = [
                            'token' => $model->genererChaineAleatoire(20),
                            'id'    => $categories[$i]['id']
                        ];
                    }

                    $model = new ResultsManager();
                    $token = $model->genererChaineAleatoire(20);
                    $_SESSION['tokenVerify'] = $token;

                    $this->render(  'gestionCategories',
                                    'layout',
                                    [
                                        'addCategorie'  => [],
                                        'token'         => $token,
                                        'valids'        => $valids,
                                        'categories'    => $categories
                                    ]);
                }
            } else {

                $model = new ResultsManager();
                $token = $model->genererChaineAleatoire(20);
                $_SESSION['tokenVerify'] = $token;

                if(isset($_FILES['fileCategorie']) && $_FILES['fileCategorie']['name'] != '') {
                    $errors[] = $messagesErrors[40];
                }

                $model      = new CategoriesManager();
                $categories = $model->getAllCategories();

                // Régénération des tokens pour chaque formulaire de suppression de la catégorie
                for($i=0; $i < count($categories); $i++) {
                    $model = new ResultsManager();
                    $_SESSION['tokenGestionCategories'][$i] = [
                        'token' => $model->genererChaineAleatoire(20),
                        'id'    => $categories[$i]['id']
                    ];
                }

                $this->render(  'gestionCategories',
                                'layout',
                                [
                                    'addCategorie'  => $addCategorie,
                                    'token'         => $token,
                                    'errors'        => $errors,
                                    'categories'    => $categories
                                ]);
            }
        }
    }

    public function activationCategorie() {

        // $verif = new \Models\Verif_admin();
        // $verif->getVerifIfAdmin();

        $errors = [];

        $model      = new CategoriesManager();
        $categories = $model->getAllIdOffCategories();
        $catExist = false;
        foreach($categories as $categorie) {
            if($categorie['id'] == $_GET['id'])
                $catExist = true;
        }

        // Récupération de la liste des messages d'erreur
        $errorsList = new errorMessages();
        $messagesErrors = $errorsList->getMessages();

        if(!$catExist)
            $errors[] = $messagesErrors[43];
        else if($_GET['ref'] != 0 && $_GET['ref'] != 1)
            $errors[] = $messagesErrors[43];


        $newRef = 0;
        if(count($errors) == 0) {

            if($_GET['ref'] == 0) $newRef = 1; else $newRef = 0;

            $addCategorie = new Categories();
            $addCategorie->setId($_GET['id']);
            $addCategorie->setActivate($newRef);

            // Modification de l'état de la catégorie
            $manager = new CategoriesManager();
            $manager->update($addCategorie);

            $model = new ResultsManager();
            $token = $model->genererChaineAleatoire(20);
            $_SESSION['tokenVerify'] = $token;

            $model      = new CategoriesManager();
            $categories = $model->getAllCategories();

            // Régénération des tokens pour chaque formulaire de suppression de la catégorie
            for($i=0; $i < count($categories); $i++) {
                $model = new ResultsManager();
                $_SESSION['tokenGestionCategories'][$i] = [
                    'token' => $model->genererChaineAleatoire(20),
                    'id'    => $categories[$i]['id']
                ];
            }

            $this->render(  'gestionCategories',
                            'layout',
                            [
                                'addCategorie'  => [],
                                'token'         => $token,
                                'categories'    => $categories
                            ]);

        }
    }

    public function deleteCategorie() {

        $errors = [];
        $valids = [];

        // Récupération de la liste des messages d'erreur
        $errorsList = new errorMessages();
        $messagesErrors = $errorsList->getMessages();

        $idExist = false;
        $tokenCorrespondance = "";

        foreach($_SESSION['tokenGestionCategories'] as $item) {
            if($item['id'] == $_POST['id'])
                $idExist = true;
                if($idExist) {
                    $tokenCorrespondance = $item['token'];
                    break;
                }
        }

        if(!$idExist || $idExist && $tokenCorrespondance != $_POST['token']) {
            $errors[] = $messagesErrors[47];
        }

        $model      = new CategoriesManager();
        $categories = $model->getAllIdOffCategories();
        $catExist   = false;
        foreach($categories as $categorie) {
            if($categorie['id'] == $_POST['id'])
                $catExist = true;
        }

        if(!$catExist)
            $errors[] = $messagesErrors[43];

        if(count($errors) == 0) {
            $model      = new ArticlesManager();
            $article    = $model->getAllArticlesByCat($_GET['id']);
            $numberOfArticle = count($article);

            if(!empty($article)) {
                $errors[] = $messagesErrors[44] . $numberOfArticle . $messagesErrors[45];
                $errors[] = $messagesErrors[46];
            } else {

                    // Récupération de l'image actuelle de la catégorie
                    $model      = new CategoriesManager();
                    $actualyPicture = $model->selectPictureCatById($_GET['id']);

                    // Si l'image n'est pas "noPicture.png", on la supprime
                    if($actualyPicture['picture'] != "noPicture.png")
                        unlink('assets/uploads/categories/'.$actualyPicture['picture']);

                    // Suppression de la catégorie
                    $model      = new CategoriesManager();
                    $model->deleteCategorie($_POST['id']);

                    // Récupération de la liste des messages de validation
                    $validsList = new ValidMessages();
                    $messagesValids = $validsList->getMessages();

                    // Ajout d'un message de validation dans le tableau pour l'affichage
                    $valids[] = $messagesValids[6];

                    // Régénération du token pour le formulaire d'ajout d'une catégorie
                    $model = new ResultsManager();
                    $token = $model->genererChaineAleatoire(20);
                    $_SESSION['tokenVerify'] = $token;

                    // Récupération de toutes les catégories pour actualiser l'affichage
                    $model      = new CategoriesManager();
                    $categories = $model->getAllCategories();

                    // Régénération des tokens pour chaque formulaire de suppression de la catégorie
                    for($i=0; $i < count($categories); $i++) {
                        $model = new ResultsManager();
                        $_SESSION['tokenGestionCategories'][$i] = [
                            'token' => $model->genererChaineAleatoire(20),
                            'id'    => $categories[$i]['id']
                        ];
                    }

                    // Envoi des données au render pour l'affichage de la vue
                    $this->render(  'gestionCategories',
                                    'layout',
                                    [
                                        'addCategorie'  => [],
                                        'token'         => $token,
                                        'valids'        => $valids,
                                        'categories'    => $categories
                                    ]);
            }
        } else {

            $model = new ResultsManager();
            $token = $model->genererChaineAleatoire(20);
            $_SESSION['tokenVerify'] = $token;

            $model      = new CategoriesManager();
            $categories = $model->getAllCategories();

            for($i=0; $i < count($categories); $i++) {
                $model = new ResultsManager();
                $_SESSION['tokenGestionCategories'][$i] = [
                    'token' => $model->genererChaineAleatoire(20),
                    'id'    => $categories[$i]['id']
                ];
            }

            $this->render(
                'gestionCategories',
                'layout',
                [
                    'addCategorie'  => [],
                    'token'         => $token,
                    'errors'        => $errors,
                    'categories'    => $categories,
                    'token'         => $token
                ]);
        }

    }
}