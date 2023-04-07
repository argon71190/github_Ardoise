<?php

namespace App;

use \Controllers\FrontController;
use \Controllers\CategoriesController;
use \Controllers\CustomersController;
use \Controllers\ScreemsController;
use \Controllers\ArticlesController;
use \Controllers\BasketController;
use \Controllers\OptionsController;
use \Controllers\TvaController;
use \Controllers\PaymentMethodController;

class Router {

    public function getRouteFromQuery() {
        if(array_key_exists('route', $_GET)) {
            switch($_GET['route']) {
                    // HOME
                case 'home':
                    $controller = new FrontController();
                    $controller->displayHome();
                    break;

                    // AJOUT ARTICLES
                case 'addArticle':
                    $controller = new ArticlesController();
                    $controller->displayFormAddArticle();
                    break;

                case 'submitFormAddArticle':
                    $controller = new ArticlesController();
                    $controller->addArticle();
                    break;

                    // CUSTOMERS
                case 'customers':
                    $controller = new CustomersController();
                    $controller->displayCustomers();
                    break;

                case 'addCustomer':
                    $controller = new CustomersController();
                    $controller->displayFormAddCustomers();
                    break;

                case 'submitFormAddCustomer':
                    $controller = new CustomersController();
                    $controller->addCustomer();
                    break;

                case 'displayOneCustomer':
                    $controller = new CustomersController();
                    $controller->displayOneCustomer($_GET['id']);
                    break;

        		case 'updateCustomer':
		            $controller = new CustomersController();
                    $controller->updateCustomer($_GET['id']);
		        break;
		    
        		case 'activationCustomer':
		            $controller = new CustomersController();
                    $controller->activationCustomer($_GET['id']);
		        break;

                case 'deleteCustomer':
                    $controller = new CustomersController();
                    $controller->deleteCustomer($_GET['id']);
		        break;

                    // CATEGORIES
                case 'categories':
                    $controller = new CategoriesController();
                    $controller->displayCategories('categories');
                    break;

                case 'category':
                    $_SESSION['category'] = $_GET['id'];
                    $controller = new CategoriesController();
                    $controller->displayAllProductsByCategory($_GET['id']);
                    break;

                case 'articleDetails':
                    $controller = new ArticlesController();
                    $controller->displayDetails();
                    break;

                    // BASKET
                case 'directAddBasket':
                    $controller = new BasketController();
                    $controller->addImmediately($_GET['id']);
                    break;

                case 'addBasket':
                    $controller = new BasketController();
                    $controller->add($_GET['id']);
                    break;

                case 'readBasket':
                    $controller = new BasketController();
                    $controller->read();
                    break;

                case 'modifArtInBasket':
                    $controller = new BasketController();
                    $controller->deleteInBasket($_GET['k']);
                    break;

                    // SCREENS
                case 'screens':
                    $controller = new ScreemsController();
                    $controller->displayScreens();
                    break;

                case 'prepareStart':
                    $controller = new ScreemsController();
                    $controller->updateDateStartOrder(intval($_GET['id']));
                    break;

                case 'prepareEnd':
                    $controller = new ScreemsController();
                    $controller->updateDateEndOrder(intval($_GET['id']));
                    break;

                case 'search':
                    $content = file_get_contents("php://input");
                    $data = json_decode($content, true);
                    $_SESSION['screen'] = $data['val'];
                    $controller = new ScreemsController();
                    $controller->displayScreens();
                    break;


                    // AFFICHAGE DES COMMANDES REMISES PLUS TARD
                case 'later':
                    $controller = new ScreemsController();
                    $controller->displayLaterOrderInScreens();
                    break;

                    // AFFICHAGE DES COMMANDES EN ATTENTE DE REGLEMENT
                case 'standBy':
                    $controller = new ScreemsController();
                    $controller->displayStandByOrders();
                    break;
                    
                    //AJOUT D'OPTIONS EN BDD
                case 'addOption':
                    $controller = new OptionsController();
                    $controller->displayFormAddOptions();
                    break;
                
                case 'submitFormAddOption':
                    $controller = new OptionsController();
                    $controller->addOption();
                    break;
                    
                    //ASSOCIATION D'OPTION A UN ARTICLE
                case 'assocOption':
                    $controller = new OptionsController();
                    $controller->displayFormAssocOption();
                    break;

                    //CATEGORIES
                case 'addCategorie':
                    $controller = new CategoriesController();
                    $controller->displayCategories("gestionCategories");
                    break;

                case 'activationCategorie':
                    $controller = new CategoriesController();
                    $controller->activationCategorie();
                    break;

                case 'delCat':
                    $controller = new CategoriesController();
                    $controller->deleteCategorie();
                    break;

                case 'submitFormAddCategorie':
                    $controller = new CategoriesController();
                    $controller->addOneCategorie();
                    break;

                    // GESTION DES TVA
                case 'addTva':
                    $controller = new TvaController();
                    $controller->addOneTva();
                    break;

                case 'activationTva':
                    $controller = new TvaController();
                    $controller->activationTva();
                break;

                // GESTION DES PAIEMENT
                case 'addPaymentMethod':
                    $controller = new PaymentMethodController();
                    $controller->addOnePaymentMethod();
                break;

                case 'activationPM':
                    $controller = new PaymentMethodController();
                    $controller->activationPaymentMethod();
                break;

                 // REQUETE AJAX

                case 'searchArticleAjax':
                    $controller = new ArticlesController();
                    $controller-> searchArticlesByCategory();

                break;    
                                        

                default:
                    $this->redirectToRoute('home');
                    break;
            }
        }
        else {
            $this->redirectToRoute('home');
        }
    }

    public function render($viewName, $layoutName, $data = []) {
        foreach($data as $key => $value) {
            $$key = $value;
        }
        $view = $viewName . '.phtml';
        include_once 'views/' . $layoutName . '.phtml';
    }

    public function redirectToRoute($routeName, $data = []) {
        $dataToTransfert = '';
        if($data !== []) {
            foreach($data as $key => $value) {
                $dataToTransfert .= '&' . $key . '=' . $value;
            }
        }
        header("Location: index.php?route=$routeName" . $dataToTransfert);
        exit();
    }
}
