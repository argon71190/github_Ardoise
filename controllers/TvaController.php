<?php

namespace Controllers;

use \App\Router;
use \Models\ArticlesManager;
use \Models\ResultsManager;
use \Models\errorMessages;
use \Models\ValidMessages;
use \Models\CategoriesManager;
use \Models\Categories;
use \Models\Tva;
use \Models\TvaManager;

class TvaController extends Router
{
    public function addOneTva() {
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

            //var_dump($tva);

            $this->render(
                'gestionTVA',
                'layout',
                [
                    'tva'   => $tva,
                    'token' => $token
                ]
            );
        } else {

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

            // R??cup??ration de la liste des messages d'erreur
            $errorsList = new errorMessages();
            $messagesErrors = $errorsList->getMessages();

            // V??rification si le formulaire provient bien de notre site
            if(isset($_SESSION['tokenVerify']) && $_SESSION['tokenVerify'] != $_POST['token'])
                $errors[] = $messagesErrors[0];

            // V??rification du champ "Nom de la cat??gorie"
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
                // V??rifier si la cat??gorie n'existe pas d??j?? dans la bdd pour ??viter les doublons
                $model              = new CategoriesManager();
                $verifExistCategorie = $model->selectOne($addCategorie['name']);

                if(!empty($verifExistCategorie))
                    $errors[] = $messagesErrors[41];

                if(count($errors) == 0) {
                    // On upload l'image si l'utilisateur en a charg?? une dans le formulaire.
                    if(isset($_FILES['fileCategorie']) && $_FILES['fileCategorie']['name'] != '') {
                        $dossier = "categories/";
                        $model = new \Models\Uploads();
                        $addCategorie['picture'] = $model->uploadFile($_FILES['fileCategorie'], $errors, $dossier);
                    }
                }

                 // Si une image devait ??tre upload??e et que l'upload s'est bien pass??
                if(count($errors) == 0) {
                    // Aucune erreur, on peut maintenant ajouter la nouvelle cat??gorie dans la bdd
                    $name         = $addCategorie['name'];
                    $picture      = $addCategorie['picture'];

                    $addCategorie = new Categories();
                    $addCategorie->setName($name);
                    $addCategorie->setPicture($picture);
                    $addCategorie->setActivate(1);

                    // R??cup??ration de la liste des messages de validation
                    $validsList = new ValidMessages();
                    $messagesValids = $validsList->getMessages();

                    // Insertion dans la bdd
                    $manager = new CategoriesManager();
                    $manager->insert($addCategorie);

                    // Ajout d'un message de validation
                    $valids[] = $messagesValids[5];

                    $model      = new CategoriesManager();
                    $categories = $model->getAllCategories();

                    // R??g??n??ration des tokens pour chaque formulaire de suppression de la cat??gorie
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

                // R??g??n??ration des tokens pour chaque formulaire de suppression de la cat??gorie
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

        // R??cup??ration de la liste des messages d'erreur
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

            // Modification de l'??tat de la cat??gorie
            $manager = new CategoriesManager();
            $manager->update($addCategorie);

            $model = new ResultsManager();
            $token = $model->genererChaineAleatoire(20);
            $_SESSION['tokenVerify'] = $token;

            $model      = new CategoriesManager();
            $categories = $model->getAllCategories();

            // R??g??n??ration des tokens pour chaque formulaire de suppression de la cat??gorie
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

        // R??cup??ration de la liste des messages d'erreur
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

                    // R??cup??ration de l'image actuelle de la cat??gorie
                    $model      = new CategoriesManager();
                    $actualyPicture = $model->selectPictureCatById($_GET['id']);

                    // Si l'image n'est pas "noPicture.png", on la supprime
                    if($actualyPicture['picture'] != "noPicture.png")
                        unlink('assets/uploads/categories/'.$actualyPicture['picture']);

                    // Suppression de la cat??gorie
                    $model      = new CategoriesManager();
                    $model->deleteCategorie($_POST['id']);

                    // R??cup??ration de la liste des messages de validation
                    $validsList = new ValidMessages();
                    $messagesValids = $validsList->getMessages();

                    // Ajout d'un message de validation dans le tableau pour l'affichage
                    $valids[] = $messagesValids[6];

                    // R??g??n??ration du token pour le formulaire d'ajout d'une cat??gorie
                    $model = new ResultsManager();
                    $token = $model->genererChaineAleatoire(20);
                    $_SESSION['tokenVerify'] = $token;

                    // R??cup??ration de toutes les cat??gories pour actualiser l'affichage
                    $model      = new CategoriesManager();
                    $categories = $model->getAllCategories();

                    // R??g??n??ration des tokens pour chaque formulaire de suppression de la cat??gorie
                    for($i=0; $i < count($categories); $i++) {
                        $model = new ResultsManager();
                        $_SESSION['tokenGestionCategories'][$i] = [
                            'token' => $model->genererChaineAleatoire(20),
                            'id'    => $categories[$i]['id']
                        ];
                    }

                    // Envoi des donn??es au render pour l'affichage de la vue
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