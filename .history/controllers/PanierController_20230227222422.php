<?php

namespace Controllers;

use \App\Router;
use \Models\CategoriesManager;
use \Models\ArticlesManager;
use \Models\OrdersManager;
use \Models\Orders;
use \Models\OrdersDetails;
use \Models\ResultsManager;
use \Models\TvaManager;
use \Models\Screens;
use \Models\errorMessages;
use \Models\ValidMessages;
use \Models\CodeBarre;
use \Models\Uploads;

class PanierController extends Router {

    private $panier;

    public function __construct() {
        if (isset($_COOKIE['panier'])) {
            $this->panier = json_decode($_COOKIE['panier'], true);
        } else {
            $this->panier = array();
        }
    }

    // Fonction qui ajoute un article dans le panier
    public function ajouter_article($id) {
        $model          = new ArticlesManager();
        $articleDetails = $model->getArticleById($id);

        if (isset($this->panier[$id])) {
            $this->panier[$id]['quantite'] += 1;
        } else {
            $this->panier[$id] = array(
                'quantite' => 1,
                'prix_unitaire' => $articleDetails['price'],
                'tva' => $articleDetails['tva_sur_place']
            );
        }
        $this->sauvegarder_panier();

        header("Location: index.php?route=categories");
        exit();
    }

    // Fonction une unité à la quantité d'un article du panier
    public function lessOne($id) {
        if (isset($this->panier[$id])) {
            $this->panier[$id]['quantite'] -= 1;
            if ($this->panier[$id]['quantite'] <= 0) {
                unset($this->panier[$id]);
            }
            $this->sauvegarder_panier();
        }
        header("Location: index.php?route=categories");
        exit();
    }

    // Fonction qui supprime un article dans le panier quelque soit sa quantité
    public function supprimerArticle($id) {
        if (isset($this->panier[$id])) {
            if (isset($this->panier[$id])) {
                unset($this->panier[$id]);
                $this->sauvegarder_panier();
            }
        }
        header("Location: index.php?route=categories");
        exit();
    }

    // Fonction qui vide le panier
    public static function viderPanier() {
        setcookie('panier', '', time() - 3600, '/');
        header("Location: index.php?route=categories");
        exit();
    }

    // Fonction qui lit le contenu du panier et l'affiche dans une table
    public function afficher_panier() {

        $panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : array();

        $tab = array();

        foreach ($panier as $id => $article) {

            $model      = new ArticlesManager();
            $articleDetails    = $model->getArticleById($id);
            $tab[] = [
                'id' => $id,
                'quantite' => $article['quantite'],
                'prix_unitaire' => $article['prix_unitaire'],
                'name' => $articleDetails['name'],
                'tva_spl' => $articleDetails['tva_sur_place'],
                'tva_emp' => $articleDetails['tva_a_emporter']
            ];
        }

        $model      = new CategoriesManager();
        $categories = $model->getCategories();

        $this->render('categories', 'layout', ['categories' => $categories, 'tab' => $tab]);
    }

    private function total_ht() {
        $total_ht = 0;
        foreach ($this->panier as $id => $article) {
            $total_ht += $article['quantite'] * $article['prix_unitaire'];
        }
        return $total_ht;
    }

    private function total_ttc() {
        $total_ttc = 0;
        foreach ($this->panier as $id => $article) {
            $total_ttc += $article['quantite'] * $article['prix_unitaire'] * (1 + $article['tva']);
        }
        return $total_ttc;
    }

    private function sauvegarder_panier() {
        setcookie('panier', json_encode($this->panier), time() + 3600, '/'); // 1h
    }

    public function displayCaisse(){
        $panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : array();

        $tab = array();
        $price = 0;

        foreach ($panier as $id => $article) {

            $model      = new ArticlesManager();
            $articleDetails    = $model->getArticleById($id);
            $tab[] = [
                'id' => $id,
                'quantite' => $article['quantite'],
                'prix_unitaire' => $article['prix_unitaire'],
                'name' => $articleDetails['name'],
                'tva_spl' => $articleDetails['tva_sur_place'],
                'tva_emp' => $articleDetails['tva_a_emporter']
            ];
            $price += $article['prix_unitaire']*$article['quantite'];
        }

        $model      = new CategoriesManager();
        $categories = $model->getCategories();

        $this->render('basketCaisse', 'layout', ['categories' => $categories, 'tab' => $tab, 'price' => $price]);
    }

    public function validatePanier() {
        $panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : array();

        $tab = array();
        $price = 0;
        $counter = 0;

        foreach ($panier as $id => $article) {

            $tab[] = [
                'id' => $id,
                'quantite' => $article['quantite'],
                'prix_unitaire' => $article['prix_unitaire']
            ];

            $price += $article['prix_unitaire']*$article['quantite'];
            $counter += $article['quantite'];
        }

        $modePay = 2;
        if($_POST["modePay"] == 'CB')     $modePay = 1;
        if($_POST['modePay'] == 'Chèque') $modePay = 3;

        $newOrder = new Orders();
        $newOrder->setPaymentMethod_id($modePay);
        $newOrder->setTotal($price);
        $newOrder->setGiven($_POST['total']);
        $newOrder->setRendu($_POST['rendu']);

        // Insertion dans la bdd de la commande et récupération du dernier id
        $manager = new OrdersManager();
        $lastId = $manager->insertOrder($newOrder);
        $_SESSION['lastId'] = intVal($lastId);

        foreach($tab as $article) {
            $newOrderDetails = new OrdersDetails();
            $newOrderDetails->setOrders_id($_SESSION['lastId']);
            $newOrderDetails->setArticle_id($article['id']);
            $newOrderDetails->setQuantity($article['quantite']);
            $newOrderDetails->setUnitary_price($article['prix_unitaire']);

            // Insertion dans la bdd de chaque article de la commande
            $manager = new OrdersManager();
            $lastId = $manager->insertOrderDetails($newOrderDetails);
        }
        $this->viderPanier();
    }

}
