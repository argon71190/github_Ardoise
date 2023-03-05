<?php

namespace Models;

class Orders extends Database {

    // Récupérer tous les articles
    public function getOrders($selectArtScreen = "1", $limit = '') {
        return $this->getAll('SELECT
                                    orders.id, orders.dateTaken, orders.dateStart, orders.receiveMode_id,
                                    receiptOrders.name AS mode,
                                    tables.name AS `table`, orders.withLater,
                                    orders.art_screen_1, orders.art_screen_2
                                FROM `orders`
                                INNER JOIN tables
                                    ON tables.id = orders.tables_id
                                INNER JOIN receiptOrders
                                    ON receiptOrders.id = orders.receiptMode_id
                                WHERE orders.finalStatut = 0 && '.$selectArtScreen.' = 1
                                ORDER BY dateTaken ASC '.$limit);
    }

    // Récupérer tous les articles
    public function getOrdersWithLater($limit='') {
        return $this->getAll('SELECT
                                    orders.id, orders.dateTaken, orders.dateStart,
                                    receiptOrders.name AS mode,
                                    tables.name AS `table`, orders.withLater
                                FROM `orders`
                                INNER JOIN tables
                                    ON tables.id = orders.tables_id
                                INNER JOIN receiptOrders
                                    ON receiptOrders.id = orders.receiptMode_id
                                WHERE orders.finalStatut = 0 AND orders.withLater = 1
                                ORDER BY dateTaken ASC '.$limit);
    }

    // Récupérer toutes les commandes en attente de règlement
    public function getStandByOrders() {
        return $this->getAll('SELECT
                                    orders.*,
                                    receiptOrders.name AS mode,
                                    tables.name AS `table`,
                                    customers.lastname AS clientLastname, customers.firstname AS clientFirstname,
                                    operators.lastname AS operatorLastname, operators.firstname AS operatorFirstname
                                FROM `orders`
                                INNER JOIN tables
                                    ON tables.id = orders.tables_id
                                INNER JOIN receiptOrders
                                    ON receiptOrders.id = orders.receiptMode_id
                                INNER JOIN customers
                                    ON customers.id = orders.customers_id
                                INNER JOIN operators
                                    ON operators.id = orders.operators_id
                                WHERE orders.paymentStatus != 1
                                ORDER BY dateTaken ASC ');
    }

    // Récupérer tous les articles
    public function getScreens() {
        return $this->getAll('  SELECT screens.id, screens.name
                                FROM `screens`
                                ORDER BY id ASC');
    }


    // Récupérer toutes les détails d'une commande en fonction de son id et de l'écran choisi
    public function getOrderDetails($id, $screen) {
        if($screen == "Tous") {
            $sql = "SELECT * FROM ordersDetails
                    INNER JOIN articles
                        ON articles.id = ordersDetails.article_id
                    INNER JOIN screens
                        ON screens.id = articles.screen_id
                    WHERE orders_id = ?";
            return $this->getAll($sql, [$id]);
        }else {
            $sql = "SELECT * FROM ordersDetails
                    INNER JOIN articles
                        ON articles.id = ordersDetails.article_id
                    INNER JOIN screens
                        ON screens.id = articles.screen_id
                    WHERE orders_id = ?
                    AND screens.name = ?";
            return $this->getAll($sql, [$id, $screen]);
        }
    }

    // Récupérer toutes les détails d'une commande pour afficher les produits à remettre plus tard
    public function getOrderDetailsOrder($id) {
            $sql = "SELECT * FROM ordersDetails
                    INNER JOIN articles
                        ON articles.id = ordersDetails.article_id
                    INNER JOIN screens
                        ON screens.id = articles.screen_id";
            return $this->getAll($sql, []);
    }

    // Récupérer tous les articles d'une catégorie
    public function getArticlesById($id) {
        //return $this->getOne( 'SELECT * FROM articles WHERE id=?', [$id] );
        return $this->getOne( 'SELECT   articles.id, articles.name, articles.categories_id, articles.shortName, articles.picture,
                                        articles.price, articles.codebarre, articles.activate,
                                        categories.name AS `category`,
                                        a.name AS `tva_sur_place`,
                                        b.name AS `tva_a_emporter`,
                                        screens.name AS screen
                                FROM `articles`
                                INNER JOIN categories
                                    ON categories.id = articles.categories_id
                                INNER JOIN tva a
                                    ON a.id = articles.tva_spl
                                INNER JOIN tva b
                                    ON b.id = articles.tva_emp
                                INNER JOIN screens
                                    ON screens.id = articles.screen_id
                                WHERE articles.id = ?', [$id] );
    }

    // Ajouter un nouvel article
    public function getAllOptionsOfArticle( $id ) {
        return $this->getAll( 'SELECT   articlesOptions.id AS article_id,
                                        articlesOptionsListing.name, articlesOptionsListing.price,
                                        articlesOptionsListing.picture, articlesOptionsListing.categoriesCondiments_id,
                                        articlesOptionsListing.shortName AS shortName,
                                        catCondiments.name AS categorie
                                FROM `articlesOptions`
                                INNER JOIN articlesOptionsListing
                                    ON articlesOptionsListing.id = articlesOptions.articlesOptionsListing_id
                                INNER JOIN catCondiments
                                    ON catCondiments.id = articlesOptionsListing.categoriesCondiments_id
                                WHERE articles_id = ?', [$id] );
    }

    // Ajouter un nouvel article
    public function addArticle($data) {
        $this->addOne('articles', $data);
    }

    // Modification de la date de début de préparation de la commande
    public function setDateStartOrder($id) {
        $this->upadateDateStartOrders('dateStart', $id);
    }

    // Modification de la date de fin de préparation de la commande et de son état
    public function setDateEndOrder($id) {
        $this->upadateDateEndOrders('dateEnd', $id);
    }


    public function getOrdersEnd($date) {
        return $this->getAll("  SELECT TIMEDIFF(dateEnd, dateStart) AS time
                                FROM `orders`
                                WHERE finalStatut = '1'
                                AND dateStart
                                LIKE '$date%'");
    }
}