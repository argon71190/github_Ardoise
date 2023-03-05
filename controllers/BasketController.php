<?php

namespace Controllers;

use \App\Router;
use \Models\CategoriesManager;
use \Models\ArticlesManager;

class BasketController extends Router
{
    // AJOUT IMMEDIAT DE L'ARTICLE DANS LE PANIER CAR PAS D'OPTION
    public function addImmediately($id) {

        $model   = new ArticlesManager();
        $article = $model->getArticlesById($_GET['id']);

        $_SESSION['basket'][] = [
            'id'            => $id,
            'Name'          => $article['shortName'],
            'Qty'           => 1,
            'Price'         => floatval($article['price']),
            'Composition'   => '',
            'Sauces'        => '',
            'Suppl.'        => '',
            'RemisPlusTard' => 'NON'
        ];

        $_SESSION['message'] = 'L\'article "' . $article['name'] . '" a bien été ajouté ! Quantité : 1';

        header('Location: index.php?route=category&id=' . htmlspecialchars($_SESSION['category']));
        exit();
    }


    // AJOUT DE L'ARTICLE DANS LE PANIER AVEC OPTION
    public function add($id) {

        $model   = new ArticlesManager();
        $article = $model->getArticlesById($_GET['id']);

        $_SESSION['basket'][] = [
            'id'            => $id,
            'Name'          => $article['shortName'],
            'Qty'           => 1,
            'Price'         => floatval($article['price']),
            "Composition"   => "-T-0",
            "Sauces"        => "M K",
            "Suppl."        => "++F",
            'RemisPlusTard' => 'OUI'
        ];

        $_SESSION['message'] = 'L\'article "' . $article['name'] . '" a bien été ajouté ! Quantité : 1';

        header('Location: index.php?route=category&id=' . htmlspecialchars($_SESSION['category']));
        exit();
    }


    // LECTURE DU PANIER
    public function read() {
        $articles = [];
        if(isset($_SESSION['basket'])) {
            $newTab     = [];
            $newTab[]   = $_SESSION['basket'][0];
            $articles   = [];

            // REDUCTION DU PANIER EN REGROUPANT LES ARTICLES EN DOUBLON ET EN MODIFIANT LA QUANTITE
            foreach($_SESSION['basket'] as $c => $v) {
                $find = 1;
                if($c != 0) {
                    foreach($newTab as $nc => $nv) {
                        if($nv['id'] === $v['id'] && $nv['Composition'] === $v['Composition'] && $nv['Sauces'] === $v['Sauces']
                                && $nv['Suppl.'] === $v['Suppl.'] && $nv['RemisPlusTard'] === $v['RemisPlusTard']) {
                            $newTab[$nc]['Qty'] += 1;
                            $find = 0;
                        }
                    }
                    if($find != 0) {
                        $newTab[] = $v;
                    }
                }
            }

            foreach($newTab as $element) {
                $model                  = new ArticlesManager();
                $find                   = $model->getArticlesById($element['id']);
                $find['Qty']            = $element['Qty'];
                $find['Composition']    = $element['Composition'];
                $find['Sauces']         = $element['Sauces'];
                $find['Suppl.']         = $element['Suppl.'];
                $find['RemisPlusTard']  = $element['RemisPlusTard'];
                $articles[]             = $find;
            }
        }

        $this->render('basket', 'layout', ['articles' => $articles]);
    }


    // AFFICHAGE DES CATEGORIES D'ARTICLES
    public function displayCategories() {
        $model      = new CategoriesManager();
        $categories = $model->getCategories();

        $this->render('categories', 'layout', ['categories' => $categories]);
    }

    // AFFICHAGE DES CATEGORIES D'ARTICLES
    public function deleteInBasket($k) {
        $_SESSION['basket'][$k]['Qty'] = 0;

        $model      = new CategoriesManager();
        $categories = $model->getCategories();

        $this->render('categories', 'layout', ['categories' => $categories]);
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