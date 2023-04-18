<?php

namespace Controllers;

use \App\Router;
use \Models\CategoriesManager;
use \Models\ArticlesManager;
use \Models\Orders;
use \Models\ResultsManager;
use \models\OptionsManager;
use \models\Options;
use \Models\ErrorMessages;
use \Models\ValidMessages;

class OptionsController extends Router
{
    public function displayFormaddOptions() {
        
        $model = new OptionsManager();
        $categories = $model->getAllCategories();
        
        $this->render(  'addOptions',
                        'layout',
                        [ 'categories' => $categories]
                        );
    }
    
    public function addOption() {
        
        $errors = [];
        $valids = [];
        
        if(    array_key_exists('optionName',  $_POST) && array_key_exists('optionShortName', $_POST)
            && array_key_exists('optionPrice',     $_POST) && array_key_exists('categorieCondiment', $_POST)
            && $_POST['submit'] == "Soumettre" ) {
                
            
            $newOption = [
                'name'      => trim(strtoupper($_POST['optionName'])),
                'shortName' => trim(strtoupper($_POST['optionShortName'])),
                'picture'   => "noPicture.png",
                'price'     => trim($_POST['optionPrice']),
                'categorie' => trim($_POST['categorieCondiment']),
                
                
            ];
            
            $errorsList = new errorMessages();
            $messagesErrors = $errorsList->getMessages();
            
            // Vérification des données formulaires
            
            // Vérification du champ "Nom de l'option"
            if(strlen($newOption['name']) < 3 || strlen($newOption['name']) > 50) {
                $errors[] = $messagesErrors[56];
            }
            
            // Vérification du champ "Nom court de l'option"
            if(strlen($newOption['shortName']) < 1 || strlen($newOption['shortName']) > 10) {
                $errors[] = $messagesErrors[57];
            }
            
            // Vérification du champ "Prix de l'option"
            if(!is_numeric($newOption['price'])){
                $errors[] = $messagesErrors[58];
            }
            
            if($newOption['price'] > 100 || $newOption['price'] <0.01 ){
                $errors[] = $messagesErrors[61];
            }
            //Vérification du champ "Catégorie de l'option"
            $categorieExist = false;
            if($newOption['categorie'] == "?") {
                $errors[] = $messagesErrors[59];
            } else {
                // Récupération de la liste des catégories de la BDD
                // Vérification si la catégorie sélectionnée est bien présente dans la BDD
                $model = new OptionsManager();
                $categories = $model->getAllCategories();
                foreach($categories as $categorie) {
                    if($categorie['id'] == $newOption['categorie'])
                        $categorieExist = true;
                }
                if(!$categorieExist){
                    $errors[] = $messagesErrors[60];
                }    
            }
            
            if(isset($_FILES['userfileOption']) && $_FILES['userfileOption']['name'] != '') {
                $size = getimagesize($_FILES['userfileOption']['tmp_name']);
                if($size[0] > 220 || $size[1] > 240){
                    $errors[] = $messagesErrors[39];
                }    
            }
           
            
            // Affectation et envoie en BDD après la vérification
            if(count($errors) == 0) {
                
            
                // On upload l'image si l'utilisateur en a chargé une dans le formulaire.
                if(isset($_FILES['userfileOption']) && $_FILES['userfileOption']['name'] != '') {
                    $dossier = "options/".$newOption['categorie'];
                    $model = new \Models\Uploads();
                    $newOption['picture'] = $model->uploadFile($_FILES['userfileOption'], $errors, $dossier);
                }
                
      
 
                $name         = $newOption['name'];
                $shortName    = $newOption['shortName'];
                $price        = $newOption['price'];
                $picture      = $newOption['picture'];
                $categorieCondiment_id = $newOption['categorie'];
            
                $newOption = new Options();
                $newOption->setName($name);
                $newOption->setShortName($shortName);
                $newOption->setPrice($price);
                $newOption->setPicture($picture);
                $newOption->setCategoriesCondiments_id($categorieCondiment_id);
            
                $manager = new OptionsManager();
                $manager->insert($newOption);
                
            
                // Récupération de la liste des messages de validation
                $validsList = new ValidMessages();
                $messagesValids = $validsList->getMessages();
            
                // Ajout d'un message de validation
                $valids[] = $messagesValids[8];
                
                $this->render('addOptions', 'layout', [
                                'newOption'    => [],
                                'categories'    => $categories,
                                'errors'        => $errors,
                                'valids'        => $valids
                ]);                
            }
        }
        
        $model = new OptionsManager();
        $categories = $model->getAllCategories();
        
        $this->render(  'addOptions',
                        'layout',
                        [
                            'newOption'    => $newOption,
                            'categories'    => $categories,
                            'errors'        => $errors
                        ]);
    }



    public function displayArticleGestion(){
        $model = new categoriesManager();
        $categories = $model->getCategories();

        $this->render(  'articleGestion',
                        'layout',
                        [ 'categories' => $categories]
                        );
    }

    public function displayArticleOption($id){
        $model = new ArticlesManager();
        $article = $model->getArticleById($id);

        $model = new OptionsManager();
        $categories = $model->getAllCategories();

        $this->render(  'articleOption',
                        'layout',
                        [ 'article'         => $article,
                          'categories'      => $categories]
                        );
    }

    public function searchOptionsByCategory() {
        $content = file_get_contents("php://input");
        $data = json_decode($content, true);
        $search = $data['category'];
        $model = new \Models\OptionsManager();
        $optionsFind = $model->getAllOptionsByCat($search);
        include 'views/templates/optionsSearch.phtml';
    }

    public function addLink() {

        //ON VERIFIE QUE LE POST EXISTE
    if(    array_key_exists('optionId',  $_POST) && array_key_exists('articleId', $_POST)){
        $errors = [];
        $valids = [];


        //ON RÉCUPERE LES MESSAGE D'ERREURS
        $errorsList = new errorMessages();
        $messagesErrors = $errorsList->getMessages();

        //ON S'ASSURE QU'IL N'Y A PAS D'ERREURS

        foreach($_POST['optionId'] as $optionId){
            $exist = false;
            $model = new \Models\OptionsManager();
            $options = $model->getOptionsId();
            foreach($options as $option){
                if($optionId == $option['id']){
                    $exist = true;
                }
            }
            if($exist == false){
                $errors[] = $messagesErrors[69];
            }
        }    

        
        $exist = false;
        foreach($_POST['optionId'] as $optionId){
            
            $model = new \Models\OptionsManager();
            $link = $model-> loadLink($_POST['articleId'], $optionId);
            if($link){
                $exist = true;
            }

        }
        if($exist == true){
            $errors[] = $messagesErrors[71];
        }



        $exist = false;
        $model = new \Models\ArticlesManager();
        $articles = $model->getArticlesId();
        foreach($articles as $article){
            if($_POST['articleId'] == $article['id']){
                $exist = true;
            }
        }
        if($exist == false){
            $errors[] = $messagesErrors[70];
        }

        if(count($errors) == 0){
            foreach($_POST['optionId'] as $optionId){
                $newLink = [
                    'articlesOptionsListing_id'      => trim(strtoupper($optionId)),
                    'articles_id' => trim(strtoupper($_POST['articleId']))
                ];

                // ON AJOUTE LE LIEN EN BDD
                $model = new \Models\OptionsManager();
                $model->addLink($newLink);
            }

                //ON ATTRAPE LE MODELE DES MESSAGES DE VALIDATION
                $validsList = new ValidMessages();
                $messagesValids = $validsList->getMessages();
                
                    // Ajout d'un message de validation
                    $valids[] = $messagesValids[14];

                $model = new ArticlesManager();
                $article = $model->getArticleById($_POST['articleId']);

                $model = new OptionsManager();
                $categories = $model->getAllCategories();

                //On affiche la vue de l'article avec sa nouvelle option et un message de validation
                $this->render(  'articleOption',
                                'layout',
                          [ 'article'       => $article,
                            'categories'    => $categories,
                            'errors'        => $errors,
                            'valids'        => $valids
                            ]
                        );
                        
        
        }
        $model = new categoriesManager();
        $categories = $model->getCategories();
        
        $this->render(  'articleGestion',
                        'layout',
                       ['categories'    => $categories,
                        'errors'        => $errors
                        ]);

    }
    $errorsList = new errorMessages();
    $messagesErrors = $errorsList->getMessages();
    $errors[] = $messagesErrors[68];

    $model = new ArticlesManager();
                $article = $model->getArticleById($_POST['articleId']);

                $model = new OptionsManager();
                $categories = $model->getAllCategories();

    $this->render(  'articleOption',
                    'layout',
                  [ 'article'       => $article,
                    'categories'    => $categories,
                    'errors'        => $errors,
                  ]);
    }

    public function deleteLink(){
        $model = new OptionsManager();
        $model->deleteLink($_GET['articleId'], $_GET['optionId']);


        $model = new ArticlesManager();
                $article = $model->getArticleById($_GET['articleId']);

                $model = new OptionsManager();
                $categories = $model->getAllCategories();

                $validsList = new ValidMessages();
                $messagesValids = $validsList->getMessages();
                
                    // Ajout d'un message de validation
                    $valids[] = $messagesValids[15];


        $this->render(  'articleOption',
                    'layout',
                  [ 'article'       => $article,
                    'categories'    => $categories,
                    'valids'        => $valids
                  ]);
    }
}
