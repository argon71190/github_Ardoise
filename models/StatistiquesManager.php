<?php

namespace Models;

class StatistiquesManager extends Database {


    // Récupérer les statistiques par jour
    public function getAllStatistiquesForDay() {
        return $this->getAll("SELECT DATE(dateTaken) AS jour, ROUND(SUM(total), 2) AS total_vendu
            FROM orders
            GROUP BY jour
            ORDER BY jour DESC");
    }

    public function getAllOrders() {
        return $this->getAll("SELECT o.id, o.paymentMethod_id, pm.name as paymentMethod, o.dateTaken, o.total,
            od.article_id, a.name as article_name, o.given, o.rendu, od.quantity, od.unitary_price
            FROM orders o
            JOIN ordersDetails od ON o.id = od.orders_id
            JOIN articles a ON od.article_id = a.id
            JOIN paymentMethod pm ON o.paymentMethod_id = pm.id
            ORDER BY o.id ASC");
    }

    // Récupérer les statistiques par mois
    public function getAllStatistiquesForMonth() {
        return $this->getAll("SELECT DATE_FORMAT(dateTaken, '%Y-%m') AS mois, ROUND(SUM(total), 2) AS total_vendu
            FROM orders
            GROUP BY mois
            ORDER BY mois DESC");
    }


    // Récupérer les statistiques par année
    public function getAllStatistiquesForYear() {
        return $this->getAll("SELECT YEAR(dateTaken) AS annee, ROUND(SUM(total), 2) AS total_vendu
            FROM orders
            GROUP BY annee
            ORDER BY annee DESC");
    }

    public function getAllStatistiquesForCategories() {
        return $this->getAll("SELECT categories.name AS categorie, SUM(quantity) AS quantite_vendue, ROUND(SUM(quantity * unitary_price), 2) AS total_vendu
            FROM ordersDetails
            INNER JOIN articles ON ordersDetails.article_id = articles.id
            INNER JOIN categories ON articles.categories_id = categories.id
            GROUP BY categorie
            ORDER BY quantite_vendue DESC");
    }


    public function getAllStatistiquesForCategoriesAndDay() {
        return $this->getAll("SELECT DATE(dateTaken) AS jour, categories.name AS categorie, SUM(quantity) AS quantite_vendue, ROUND(SUM(quantity * unitary_price), 2) AS total_vendu
            FROM ordersDetails
            INNER JOIN articles ON ordersDetails.article_id = articles.id
            INNER JOIN categories ON articles.categories_id = categories.id
            INNER JOIN orders ON ordersDetails.orders_id = orders.id
            GROUP BY jour, categorie
            ORDER BY jour DESC, total_vendu DESC");
    }


    public function getAllStatistiquesForCategoriesAndMonth() {
        return $this->getAll("SELECT DATE_FORMAT(dateTaken, '%Y-%m') AS mois, categories.name AS categorie, SUM(quantity) AS quantite_vendue, ROUND(SUM(quantity * unitary_price), 2) AS total_vendu
            FROM ordersDetails
            INNER JOIN articles ON ordersDetails.article_id = articles.id
            INNER JOIN categories ON articles.categories_id = categories.id
            INNER JOIN orders ON ordersDetails.orders_id = orders.id
            GROUP BY mois, categorie
            ORDER BY mois DESC, total_vendu DESC");
    }

    public function getAllStatistiquesForCategoriesAndYear() {
        return $this->getAll("SELECT YEAR(dateTaken) AS annee, categories.name AS categorie, SUM(quantity) AS quantite_vendue, ROUND(SUM(quantity * unitary_price), 2) AS total_vendu
            FROM ordersDetails
            INNER JOIN articles ON ordersDetails.article_id = articles.id
            INNER JOIN categories ON articles.categories_id = categories.id
            INNER JOIN orders ON ordersDetails.orders_id = orders.id
            GROUP BY annee, categorie
            ORDER BY annee DESC, total_vendu DESC");
    }

    // Récupérer les statistiques par article
    public function getAllStatistiquesForArticles($year) {
        return $this->getAll("SELECT articles.name AS article, SUM(quantity) AS quantite_vendue, ROUND(SUM(quantity * unitary_price), 2) AS total_vendu
            FROM ordersDetails
            INNER JOIN articles ON ordersDetails.article_id = articles.id
            INNER JOIN orders ON ordersDetails.id = orders.id
            WHERE orders.dateTaken LIKE ?
            GROUP BY article
            ORDER BY quantite_vendue DESC", ['%'.$year.'%']);
    }

    // Récupérer les statistiques par article et par jour
    public function getAllStatistiquesForArticleAndDay() {
        return $this->getAll("SELECT DATE(dateTaken) AS date, articles.name AS article, SUM(quantity) AS quantite_vendue, ROUND(SUM(quantity * unitary_price), 2) AS total_vendu
            FROM ordersDetails
            INNER JOIN articles ON ordersDetails.article_id = articles.id
            INNER JOIN orders ON ordersDetails.orders_id = orders.id
            GROUP BY date, article
            ORDER BY date DESC, total_vendu DESC");
    }

    // Récupérer les statistiques par article et par mois
    public function getAllStatistiquesForArticleAndMonth() {
        return $this->getAll("SELECT DATE_FORMAT(dateTaken, '%Y-%m') AS mois, articles.name AS article, SUM(quantity) AS quantite_vendue, ROUND(SUM(quantity * unitary_price), 2) AS total_vendu
            FROM ordersDetails
            INNER JOIN articles ON ordersDetails.article_id = articles.id
            INNER JOIN orders ON ordersDetails.orders_id = orders.id
            GROUP BY mois, article
            ORDER BY mois DESC, total_vendu DESC");
    }

    // Récupérer les statistiques par article et pour la date du jour
    public function getAllStatistiquesForArticleAndDateNow() {
        return $this->getAll("SELECT articles.name AS article, SUM(quantity) AS quantite_vendue, ROUND(SUM(quantity * unitary_price), 2) AS total_vendu
            FROM ordersDetails
            INNER JOIN articles ON ordersDetails.article_id = articles.id
            INNER JOIN orders ON ordersDetails.orders_id = orders.id
            WHERE DATE(dateTaken) = CURDATE()
            GROUP BY article
            ORDER BY article ASC");
    }

    public function getStatistiquesByOneDay($date) {
        return $this->getAll("SELECT articles.name AS article, SUM(quantity) AS quantite_vendue, ROUND(SUM(quantity * unitary_price), 2) AS total_vendu
            FROM ordersDetails
            INNER JOIN articles ON ordersDetails.article_id = articles.id
            INNER JOIN orders ON ordersDetails.orders_id = orders.id
            WHERE DATE(dateTaken) = ?
            GROUP BY article
            ORDER BY article ASC", [$date]);
    }


    public function getTest() {
        return $this->getAll("SELECT
                YEAR(o.dateTaken) as year,
                MONTH(o.dateTaken) as month,
                a.name as article_name,
                COUNT(od.article_id) as sales_count
            FROM
                orders o
                JOIN ordersDetails od ON o.id = od.orders_id
                JOIN articles a ON od.article_id = a.id
            WHERE
                YEAR(o.dateTaken) = '2023'
            GROUP BY
                YEAR(o.dateTaken), MONTH(o.dateTaken), od.article_id
            ORDER BY
                YEAR(o.dateTaken), MONTH(o.dateTaken), a.name");
    }


    public function getTest2() {
        return $this->getAll("SELECT c.name AS category, a.name AS article,
            COALESCE(SUM(od.quantity), 0) AS sales_qty,
            COALESCE(SUM(od.unitary_price * od.quantity), 0) AS sales_amount,
            DATE_FORMAT(o.dateTaken, '%Y') AS month
        FROM articles a
        INNER JOIN categories c ON a.categories_id = c.id
        LEFT JOIN ordersDetails od ON a.id = od.article_id
        LEFT JOIN orders o ON od.orders_id = o.id
        WHERE DATE_FORMAT(o.dateTaken, '%Y') = '2023'
        GROUP BY c.name, a.name, month
        ORDER BY c.name, a.name");
    }








    // Récupérer toutes les options d'une article
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
    public function addArticle( $data ) {
        $this->addOne( 'articles', $data );
    }

    // Ajouter un nouvel article
    public function findCodeBarre( $codeBarre ) {
        return $this->getOne('SELECT *
                                FROM `articles`
                                WHERE codebarre = ?', [$codeBarre]);
    }

    // *** AJOUTER UN ARTICLE
    public function insert(Articles $Articles): void{

        $datas = [
            'name'          => $Articles->getName(),
            'shortName'     => $Articles->getShortName(),
            'picture'       => $Articles->getPicture(),
            'price'         => $Articles->getPrice(),
            'categories_id' => $Articles->getCategorie_id(),
            'tva_spl'       => $Articles->getTva_spl(),
            'tva_emp'       => $Articles->getTva_emp(),
            'codebarre'     => $Articles->getCodebarre(),
            'activate'      => $Articles->getActivate(),
            'screen_id'     => $Articles->getScreen_id()
        ];

        $this->addOne('articles', $datas);
    }

}