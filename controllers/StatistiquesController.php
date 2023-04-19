<?php

namespace Controllers;

use \App\Router;
use \Models\CategoriesManager;
use \Models\StatistiquesManager;
use \Models\Articles;
use \Models\ResultsManager;
use \Models\TvaManager;
use \Models\Screens;
use \Models\errorMessages;
use \Models\ValidMessages;
use \Models\CodeBarre;
use \Models\Uploads;

class StatistiquesController extends Router {

    public function displayStats() {
        $this->render('statistics/displayStatistiques', 'layout');
    }

    public function getAllOrders() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllOrders();

        $previousOrderId = null;

        // Affichage de l'en-tête de la table
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID commande</th>";
        echo "<th>Date de la commande</th>";
        echo "<th>Méthode de paiement</th>";
        echo "<th>Total</th>";
        echo "<th>ID article</th>";
        echo "<th>Quantité</th>";
        echo "<th>Prix unitaire</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Parcours des résultats avec une boucle foreach
        foreach ($statistiques as $row) {
            // Vérification si l'ID de la commande a déjà été affiché
            if ($row['id'] != $previousOrderId) {
                // Affichage d'une nouvelle ligne pour la commande
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['dateTaken'] . "</td>";
                echo "<td>" . $row['paymentMethod'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";
                echo "<td>" . $row['given'] . "</td>";
                echo "<td>" . $row['rendu'] . "</td>";
                echo "</tr>";

                // Stockage de l'ID de la commande actuelle
                $previousOrderId = $row['id'];
            } else {
                // Affichage d'une nouvelle ligne pour l'élément de commande
                echo "<tr>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>" . $row['article_name'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['unitary_price'] . "</td>";
                echo "</tr>";
            }
        }

        // Affichage de la fin de la table
        echo "</tbody>";
        echo "</table>";

         die;

        $this->render('displayArticles', 'layout', [    'stats'       => $statistiques]);
    }



    public function getStatsForDay() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForDay();

        $this->render('statistics/displayStatsForDay', 'layout', ['statistiques' => $statistiques]);
    }

    public function getStatsForOneDay() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForDay();

        $this->render('statistics/displayStatsForDay', 'layout', ['statistiques' => $statistiques]);
    }

    public function getStatsForMonth() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForMonth();

        $this->render('statistics/displayStatsForMonth', 'layout', [    'statistiques'       => $statistiques]);
    }

    public function getStatsForYear() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForYear();

        $this->render('statistics/displayStatsForYear', 'layout', [    'statistiques'       => $statistiques]);
    }

    public function getStatsForArticles() {
        if(isset($_POST) && empty($_POST)){
            $this->render('statistics/displayStatsForArticle', 'layout');
        }
        else{
            $year           = $_POST['selectYear'];
            $model          = new StatistiquesManager();
            $statistiques   = $model->getAllStatistiquesForArticles($year);
    
            $this->render('statistics/displayStatsForArticle', 'layout', ['statistiques' => $statistiques, 'year' => $year]);
        }
    }

    public function getStatsForCategories() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForCategories();
        var_dump($statistiques); die;

        $this->render('displayArticles', 'layout', [    'stats'       => $statistiques]);
    }

    public function getAllStatistiquesForCategoriesAndDay() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForCategoriesAndDay();

        $jour_precedent = '';

        // afficher les données dans une table
        echo "<table>";
        echo "<tr><th>jour</th><th>Catégorie</th><th>Quantité vendue</th><th>Total vendu</th></tr>";

        foreach($statistiques as $elem) {
            // vérifier si le jour a changé
            if ($elem['jour'] != $jour_precedent) {
                echo "<tr><td colspan='4'>" . $elem['jour'] . "</td></tr>";
                // mettre à jour la variable pour stocker le jour précédent
                $jour_precedent = $elem['jour'];
            }
            echo "<tr>";
            echo "<td></td>";
            echo "<td>" . $elem['categorie'] . "</td>";
            echo "<td>" . $elem['quantite_vendue'] . "</td>";
            echo "<td>" . $elem['total_vendu'] . "€</td>";
            echo "</tr>";
        }

        echo "</table>";

        var_dump($statistiques); die;

        $this->render('displayArticles', 'layout', [    'stats'       => $statistiques]);
    }

    public function getAllStatistiquesForCategoriesAndMonth() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForCategoriesAndMonth();

        $jour_precedent = '';

        // afficher les données dans une table
        echo "<table>";
        echo "<tr><th>mois</th><th>Catégorie</th><th>Quantité vendue</th><th>Total vendu</th></tr>";

        foreach($statistiques as $elem) {
            // vérifier si le jour a changé
            if ($elem['mois'] != $jour_precedent) {
                echo "<tr><td colspan='4'>" . $elem['mois'] . "</td></tr>";
                // mettre à jour la variable pour stocker le jour précédent
                $jour_precedent = $elem['mois'];
            }
            echo "<tr>";
            echo "<td></td>";
            echo "<td>" . $elem['categorie'] . "</td>";
            echo "<td>" . $elem['quantite_vendue'] . "</td>";
            echo "<td>" . $elem['total_vendu'] . "€</td>";
            echo "</tr>";
        }

        echo "</table>";

        var_dump($statistiques); die;

        $this->render('displayArticles', 'layout', [    'stats'       => $statistiques]);
    }

    public function getAllStatistiquesForCategoriesAndYear() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForCategoriesAndYear();


        $jour_precedent = '';

        // afficher les données dans une table
        echo "<table>";
        echo "<tr><th>Année</th><th>Catégorie</th><th>Quantité vendue</th><th>Total vendu</th></tr>";

        foreach($statistiques as $elem) {
            // vérifier si le jour a changé
            if ($elem['annee'] != $jour_precedent) {
                echo "<tr><td colspan='4'>" . $elem['annee'] . "</td></tr>";
                // mettre à jour la variable pour stocker le jour précédent
                $jour_precedent = $elem['annee'];
            }
            echo "<tr>";
            echo "<td></td>";
            echo "<td>" . $elem['categorie'] . "</td>";
            echo "<td>" . $elem['quantite_vendue'] . "</td>";
            echo "<td>" . $elem['total_vendu'] . "€</td>";
            echo "</tr>";
        }

        echo "</table>";
        var_dump($statistiques); die;

        $this->render('displayArticles', 'layout', [    'stats'       => $statistiques]);
    }

    public function getAllStatistiquesForArticleAndDay() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForArticleAndDay();

        $jour_precedent = '';

        // afficher les données dans une table
        echo "<table>";
        echo "<tr><th>Année</th><th>Catégorie</th><th>Quantité vendue</th><th>Total vendu</th></tr>";

        foreach($statistiques as $elem) {
            // vérifier si le jour a changé
            if ($elem['date'] != $jour_precedent) {
                echo "<tr><td colspan='4'>" . $elem['date'] . "</td></tr>";
                // mettre à jour la variable pour stocker le jour précédent
                $jour_precedent = $elem['date'];
            }
            echo "<tr>";
            echo "<td></td>";
            echo "<td>" . $elem['article'] . "</td>";
            echo "<td>" . $elem['quantite_vendue'] . "</td>";
            echo "<td>" . $elem['total_vendu'] . "€</td>";
            echo "</tr>";
        }

        echo "</table>";

        var_dump($statistiques); die;

        $this->render('displayArticles', 'layout', [    'stats'       => $statistiques]);
    }

    public function getAllStatistiquesForArticleAndDateNow() {

        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForArticleAndDateNow();

        // afficher les données dans une table
        echo "<table>";
        echo "<tr><th>Catégorie</th><th>Quantité vendue</th><th>Total vendu</th></tr>";

        foreach($statistiques as $elem) {
            echo "<tr>";
            echo "<td>Ahourd'hui</td>";
            echo "<td>" . $elem['article'] . "</td>";
            echo "<td>" . $elem['quantite_vendue'] . "</td>";
            echo "<td>" . $elem['total_vendu'] . "€</td>";
            echo "</tr>";
        }

        echo "</table>";

        var_dump($statistiques); die;

        $this->render('displayArticles', 'layout', [    'stats'       => $statistiques]);
    }

    public function getStatistiquesByOneDay() {
        if(isset($_POST) && empty($_POST)){
            $this->render('statistics/displayStatistiquesByOneDay', 'layout');
        }
        else{
            $date           = $_POST['date'];
            $model          = new StatistiquesManager();
            $statistiques   = $model->getStatistiquesByOneDay($date);
        
            $this->render('statistics/displayStatistiquesByOneDay', 'layout', ['statistiques' => $statistiques, 'date' => $date]);
        }
    }

    public function getAllStatistiquesForArticleAndMonth() {

        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForArticleAndMonth();


        $jour_precedent = '';

        // afficher les données dans une table
        echo "<table>";
        echo "<tr><th>Année</th><th>Catégorie</th><th>Quantité vendue</th><th>Total vendu</th></tr>";

        foreach($statistiques as $elem) {
            // vérifier si le jour a changé
            if ($elem['mois'] != $jour_precedent) {
                echo "<tr><td colspan='4'>" . $elem['mois'] . "</td></tr>";
                // mettre à jour la variable pour stocker le jour précédent
                $jour_precedent = $elem['mois'];
            }
            echo "<tr>";
            echo "<td></td>";
            echo "<td>" . $elem['article'] . "</td>";
            echo "<td>" . $elem['quantite_vendue'] . "</td>";
            echo "<td>" . $elem['total_vendu'] . "€</td>";
            echo "</tr>";
        }

        echo "</table>";

        var_dump($statistiques); die;

        $this->render('displayArticles', 'layout', [    'stats'       => $statistiques]);
    }


    public function getAllStatsForArticleAndMonthInYear() {

        $model          = new StatistiquesManager();
        $statistiques   = $model->getTest();

        // Tableau pour stocker les résultats
        $table = array();

        // Boucle sur les résultats de la requête
        foreach ($statistiques as $row) {
            $month = intval($row['month']);
            $article_name = $row['article_name'];
            $sales_count = intval($row['sales_count']);

            // Si l'article n'est pas déjà présent dans le tableau, on l'ajoute
            if (!isset($table[$article_name])) {
                $table[$article_name] = array_fill(1, 12, 0);
            }

            // On ajoute le nombre de ventes pour le mois correspondant
            $table[$article_name][$month] = $sales_count;
        }

        $mois = array(
            'Janvier',
            'Février',
            'Mars',
            'Avril',
            'Mai',
            'Juin',
            'Juillet',
            'Août',
            'Septembre',
            'Octobre',
            'Novembre',
            'Décembre'
        );

        $this->render('displayResultsStatistiques', 'layout',
            ['statistiques' => $statistiques,
            'table' => $table,
            'mois' => $mois]);


    }
}

/*
        foreach ($statistiques as $row) {
            $month = intval($row['month']);
            $article_name = $row['article_name'];
            $sales_count = intval($row['sales_count']);

            // Si l'article n'est pas déjà présent dans le tableau, on l'ajoute
            if (!isset($table[$article_name])) {
                $table[$article_name] = array_fill(1, 12, 0);
            }

            // On ajoute le nombre de ventes pour le mois correspondant
            $table[$article_name][$month] = $sales_count;
        }

        // Tableau HTML pour afficher les résultats
        echo "<table border='1'>\n";
        echo "<tr><th>Article</th>";
        for ($month = 1; $month <= 12; $month++) {
            $month_name = date("F", mktime(0, 0, 0, $month, 1));
            echo "<th>$month_name</th>";
        }
        echo "</tr>\n";

        foreach ($table as $article_name => $sales_by_month) {
            echo "<tr><td>$article_name</td>";
            for ($month = 1; $month <= 12; $month++) {
                echo "<td>{$sales_by_month[$month]}</td>";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    }
}*/