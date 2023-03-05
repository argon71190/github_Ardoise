<?php

namespace Controllers;

use \App\Router;
use \Models\CategoriesManager;
use \Models\ArticlesManager;
use \Models\Articles;
use \Models\ResultsManager;
use \Models\TvaManager;
use \Models\Screens;
use \Models\errorMessages;
use \Models\ValidMessages;
use \Models\CodeBarre;
use \Models\Uploads;

class ArticlesController extends Router {

    public function displayDetails() {
        $model      = new ArticlesManager();
        $article    = $model->getArticlesById($_GET['id']);
        $options    = $model->getAllOptionsOfArticle($_GET['id']);

        $model      = new CategoriesManager();
        $categories = $model->getCategoriesCondiments();

        $this->render('displayArticles', 'layout', [    'article'       => $article,
                                                        'options'       => $options,
                                                        'categories'    => $categories]);
    }

    public function displayCategories() {
        $model      = new CategoriesManager();
        $categories = $model->getCategories();

        $this->render('categories', 'layout', ['categories' => $categories]);
    }

    public function displayFormAddArticle() {

        //$ifAdmin = new \Models\VerifAdminManager();
        //$ifAdmin->getVerifIfAdmin();

        $model      = new \Models\CategoriesManager();
        $categories = $model->getAllCategories();

        $model      = new \Models\TvaManager();
        $tva_spl    = $model->getAllTva();

        $model      = new \Models\Screens();
        $screens    = $model->getAllScreens();

        $model      = new ResultsManager();
        $token      = $model->genererChaineAleatoire(20);
        $_SESSION['tokenVerify'] = $token;

        $newArticle = [
            'name'      => '',
            'shortName' => '',
            'picture'   => '',
            'price'     => '',
            'categorie' => '',
            'tva_spl'   => '',
            'tva_emp'   => '',
            'codeBarre' => '',
            'activate'  => '',
            'screen'    => ''
        ];

        $this->render(  'addArticles',
                        'layout',
                        [
                            'newArticle'    => $newArticle,
                            'token'         => $token,
                            'categories'    => $categories,
                            'tva_spl'       => $tva_spl,
                            'tva_emp'       => $tva_spl,
                            'screens'       => $screens
                        ]);

    }

    public function addArticle() {

        // $ifAdmin = new \Models\VerifAdminManager();
        // $ifAdmin->getVerifIfAdmin();

        $errors = [];
        $valids = [];

        $newArticle = [
            'name'      => '',
            'shortName' => '',
            'picture'   => '',
            'price'     => '',
            'categorie' => '',
            'tva_spl'   => '',
            'tva_emp'   => '',
            'codeBarre' => '',
            'activate'  => '',
            'screen'    => ''
        ];

        if(    array_key_exists('longName',  $_POST) && array_key_exists('shortName', $_POST)
            && array_key_exists('price',     $_POST) && array_key_exists('categorie', $_POST)
            && array_key_exists('spl_tva',   $_POST) && array_key_exists('emp_tva',   $_POST)
            && array_key_exists('code',      $_POST) && array_key_exists('active',    $_POST)
            && array_key_exists('screen',    $_POST) && array_key_exists('submit',    $_POST)
            && array_key_exists('token',     $_POST) && $_POST['submit'] == "Soumettre" ) {

            $newArticle = [
                'name'      => trim(strtoupper($_POST['longName'])),
                'shortName' => trim(strtoupper($_POST['shortName'])),
                'picture'   => "noPicture.png",
                'price'     => trim($_POST['price']),
                'categorie' => trim($_POST['categorie']),
                'tva_spl'   => trim($_POST['spl_tva']),
                'tva_emp'   => trim($_POST['emp_tva']),
                'codeBarre' => trim($_POST['code']),
                'activate'  => trim($_POST['active']),
                'screen'    => trim($_POST['screen'])
            ];

            // Récupération de la liste des messages d'erreur
            $errorsList = new errorMessages();
            $messagesErrors = $errorsList->getMessages();

            // Vérification si le formulaire provient bien de notre site
            if(isset($_SESSION['tokenVerify']) && $_SESSION['tokenVerify'] != $_POST['token'])
                $errors[] = $messagesErrors[0];

            // Vérification du champ "Nom"
            if(strlen($newArticle['name']) < 3 || strlen($newArticle['name']) > 50)
                $errors[] = $messagesErrors[24];

            // Vérification du champ "shortName"
            if(strlen($newArticle['shortName']) < 3 || strlen($newArticle['shortName']) > 20)
                $errors[] = $messagesErrors[25];

            // Vérification du champ "Prix"
            if(!is_numeric($newArticle['price']))
                $errors[] = $messagesErrors[26];

            // Vérification du champ "Catégorie"
            $categorieExist = false;
            if($newArticle['categorie'] == "?") {
                $errors[] = $messagesErrors[27];
            } else {
                // Récupération de la liste des catégories de la BDD
                // Vérification si la catégorie sélectionnée est bien présente dans la BDD
                $model      = new \Models\CategoriesManager();
                $categories = $model->getAllCategories();
                foreach($categories as $categorie) {
                    if($categorie['id'] == $newArticle['categorie'])
                        $categorieExist = true;
                }
                if(!$categorieExist)
                    $errors[] = $messagesErrors[28];
            }

            // Vérification du champ "TVA sur place"
            // Récupération de la liste des TVA de la BDD
            $model   = new \Models\TvaManager();
            $tvaList = $model->getAllTva();

            $TVA_spl_Exist = false;
            if($newArticle['tva_spl'] == "?") {
                $errors[] = $messagesErrors[29];
            } else {
                // Vérification si la TVA sélectionnée est bien présente dans la BDD
                foreach($tvaList as $tva) {
                    if($tva['id'] == $newArticle['tva_spl'])
                        $TVA_spl_Exist = true;
                }
                if(!$TVA_spl_Exist)
                    $errors[] = $messagesErrors[30];
            }

            // Vérification du champ "TVA à emporter"
            $TVA_emp_Exist = false;
            if($newArticle['tva_emp'] == "?") {
                $errors[] = $messagesErrors[31];
            } else {
                // Vérification si la TVA sélectionnée est bien présente dans la BDD
                foreach($tvaList as $tva) {
                    if($tva['id'] == $newArticle['tva_emp'])
                        $TVA_emp_Exist = true;
                }
                if(!$TVA_emp_Exist)
                    $errors[] = $messagesErrors[32];
            }

            // Vérification du champ "Activation"
            if($newArticle['activate'] != "0" && $newArticle['activate'] != "1")
                $errors[] = $messagesErrors[33];

            // Vérification du champ "Ecran"
            $screen_Exist = false;
            if($newArticle['screen'] == "?") {
                $errors[] = $messagesErrors[34];
            } else {
                // Récupération de la liste des écrans.
                // Vérification si l'écran sélectionné est bien présent dans la BDD
                $model      = new \Models\Screens();
                $screens    = $model->getAllScreens();
                foreach($screens as $screen) {
                    if($screen['id'] == $newArticle['screen'])
                        $screen_Exist = true;
                }
                if(!$screen_Exist)
                    $errors[] = $messagesErrors[35];
            }

            // Vérification du champ "Code barre"
            // - Il peut être vide si l'article n'a pas de code barre.
            // - Si n'est pas vide, il doit obligatoirement comporter 13 chiffres, ni plus ni moins, et aucun autre caractère.
            // - Ce champ ne peut pas être de type number car un code barre peut débuté par un 0.
            if(!empty($newArticle['codeBarre'])) {
                if(strlen($newArticle['codeBarre']) != 13) {
                    $errors[] = $messagesErrors[36];
                } else {
                    if(preg_match("/[^0-9]/", $newArticle['codeBarre']))
                        $errors[] = $messagesErrors[37];
                }
            }

            if(isset($_FILES['userfileArticle']) && $_FILES['userfileArticle']['name'] != '') {
                $size = getimagesize($_FILES['userfileArticle']['tmp_name']);
                if($size[0] > 220 || $size[1] > 240)
                    $errors[] = $messagesErrors[39];
            }

            // Si le formulaire ne contient pas erreur.
            if(count($errors) == 0) {
                // Attention : Deux articles ne peuvent avoir le même code barre
                if(!empty($newArticle['codeBarre'])) {
                    // Si le code barre n'est pas vide, on vérifie s'il n'existe pas déjà dans la BDD
                    $model       = new \Models\ArticlesManager();
                    $articleFind = $model->findCodeBarre($newArticle['codeBarre']);
                    if(!empty($articleFind))
                        $errors[] = $messagesErrors[38];

                    // Finalement, le formulaire est bien rempli et le code barre est bon !
                    if(count($errors) == 0) {
                        // On upload l'image si l'utilisateur en a chargé une dans le formulaire.
                        if(isset($_FILES['userfileArticle']) && $_FILES['userfileArticle']['name'] != '') {
                            $dossier = "articles/".$newArticle['categorie'];
                            $model = new \Models\Uploads();
                            $newArticle['picture'] = $model->uploadFile($_FILES['userfileArticle'], $errors, $dossier);
                        }

                        // Si l'upload s'est bien passé
                        if(count($errors) == 0) {
                            // Aucune erreur, on peut maintenant ajouter le nouvel article dans la bdd
                            $name         = $newArticle['name'];
                            $shortName    = $newArticle['shortName'];
                            $picture      = $newArticle['picture'];
                            $price        = $newArticle['price'];
                            $categorie_id = $newArticle['categorie'];
                            $tva_spl      = $newArticle['tva_spl'];
                            $tva_emp      = $newArticle['tva_emp'];
                            $codebarre    = $newArticle['codeBarre'];
                            $activate     = $newArticle['activate'];
                            $screen_id    = $newArticle['screen'];

                            // Création de l'image code barre si le code barre a été renseigné
                            if(!empty($newArticle['codeBarre'])) {
                                $model          = new CodeBarre();
                                $model->generate($codebarre);
                            }

                            $newArticle = new Articles();
                            $newArticle->setName($name);
                            $newArticle->setShortName($shortName);
                            $newArticle->setPicture($picture);
                            $newArticle->setPrice($price);
                            $newArticle->setCategorie_id($categorie_id);
                            $newArticle->setTva_spl($tva_spl);
                            $newArticle->setTva_emp($tva_emp);
                            $newArticle->setCodebarre($codebarre);
                            $newArticle->setActivate($activate);
                            $newArticle->setScreen_id($screen_id);

                            // Récupération de la liste des messages de validation
                            $validsList = new ValidMessages();
                            $messagesValids = $validsList->getMessages();

                            // Insertion dans la bdd
                            $manager = new ArticlesManager();
                            $manager->insert($newArticle);

                            // Ajout d'un message de validation
                            $valids[] = $messagesValids[3];
                            $valids[] = $messagesValids[4];

                            // Etant donné que je reste sur le formulaire, je regénère un token
                            $model = new ResultsManager();
                            $token = $model->genererChaineAleatoire(20);
                            $_SESSION['tokenVerify'] = $token;

                            $model      = new \Models\CategoriesManager();
                            $categories = $model->getAllCategories();

                            $model      = new \Models\TvaManager();
                            $tva_spl    = $model->getAllTva();

                            $model      = new \Models\Screens();
                            $screens    = $model->getAllScreens();

                            $this->render('addArticles', 'layout', [
                                'newArticle'    => [],
                                'token'         => $token,
                                'categories'    => $categories,
                                'tva_spl'       => $tva_spl,
                                'tva_emp'       => $tva_spl,
                                'screens'       => $screens,
                                'errors'        => $errors,
                                'valids'        => $valids
                            ]);

                            // Inutile de régénérer un token si redirection
                            // header('Location: index.php?page=customers');
                            // exit();
                        }
                    }
                }
            }
        }

        $model      = new \Models\CategoriesManager();
        $categories = $model->getAllCategories();

        $model      = new \Models\TvaManager();
        $tva_spl    = $model->getAllTva();
        $tva_emp    = $model->getAllTva();

        $model      = new \Models\Screens();
        $screens    = $model->getAllScreens();

        $model = new ResultsManager();
        $token = $model->genererChaineAleatoire(20);
        $_SESSION['tokenVerify'] = $token;

        if(isset($_FILES['userfileArticle']) && $_FILES['userfileArticle']['name'] != '') {
            $errors[] = $messagesErrors[40];
        }

        $this->render(  'addArticles',
                        'layout',
                        [
                            'newArticle'    => $newArticle,
                            'token'         => $token,
                            'categories'    => $categories,
                            'tva_spl'       => $tva_spl,
                            'tva_emp'       => $tva_emp,
                            'screens'       => $screens,
                            'errors'        => $errors
                        ]);

    }

/*
    public function displayAllProductsByCategory() {
        $categoriesModel = new Category();
        $roomModel       = new Room();
        $categories      = $categoriesModel->getCategories();
        $roomsByCat      = [];

        foreach( $categories as $category ) {
            $roomsByCat[ $category['name'] ] = $roomModel->getRoomsByCat( $category['id'] );
        }

        if( isset( $_GET['roomid'] ) && !empty( $_GET['roomid'] ) ) {
            $messageModel = new Message();
            $currentRoom = $roomModel->getRoomById( $_GET['roomid'] );
            $messages = $messageModel->getRoomMessagesOrderByDateAsc( $_GET['roomid'] );
        }
        else {
            $messages = [];
        }

        $this->render(
            'chats',
            'layout',
                [   'categories'    => $categories,
                    'roomsByCat'    => $roomsByCat,
                    'currentRoom'   => $currentRoom,
                    'messages'      => $messages
                ]
        );
    }

    public function displayRoomForm() {
        $categoriesModel = new Category();
        $categories = $categoriesModel->getCategories();
        $this->render(
            'newRoom',
            'layout',
                [   'categories' => $categories
            ]
        );
    }*/
}