<?php

namespace Controllers;

use \App\Router;
use LDAP\Result;
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
        
        $this->render('statistics/displayOrders', 'layout', [    'statistiques'       => $statistiques]);
    }

    public function getOrdersByDay() {

        if(!isset($_POST['date'])){
            $date           = date("Y-m-d", time());
        }
        elseif(isset($_POST['date'])){
            $date           = $_POST['date'];
        }

        $model          = new StatistiquesManager();
        $statistiques   = $model->getOrdersByDate($date);
        
        $this->render('statistics/displayOrdersByDay', 'layout', [    'statistiques'       => $statistiques]);
    }

    public function getOrdersByMonth() {

        if(!isset($_POST['date'])){
            $date           = date("Y-m", time());
        }
        elseif(isset($_POST['date'])){
            $date           = $_POST['date'];
        }

        $model          = new StatistiquesManager();
        $statistiques   = $model->getOrdersByDate($date);
        
        $this->render('statistics/displayOrdersByMonth', 'layout', [    'statistiques'       => $statistiques]);
    }

    public function getOrdersByYear() {

        if(!isset($_POST['date'])){
            $date           = date("Y", time());
        }
        elseif(isset($_POST['date'])){
            $date           = $_POST['date'];
        }

        $model          = new StatistiquesManager();
        $statistiques   = $model->getOrdersByDate($date);
        
        $this->render('statistics/displayOrdersByYear', 'layout', [    'statistiques'       => $statistiques]);
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
        $article;
        if(isset($_POST) && empty($_POST)){
            $article = "";
        }
        else{
            $article = $_POST['selectArticle'];
        }

        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForArticleAndMonth();

        for($i=0; $i<count($statistiques); $i++){
            $explodeDate=explode("-", $statistiques[$i]['mois']);
            $month = ["Janvier", "Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre"];
            $date = $month[intval($explodeDate[1])-1]." ".$explodeDate[0];
            $statistiques[$i]["newDate"]=$date;
        }

        $this->render('statistics/displayStatsForArticle', 'layout', ['statistiques' => $statistiques, 'article' => $article]);
    }

    public function getAllStatistiquesForArticlesAndYear() {
        $year;
        if(isset($_POST) && empty($_POST)){
            $year = date("Y", time());
        }
        else{
            $year = $_POST['selectYear'];
        }
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForArticles($year);

        $this->render('statistics/displayStatsForArticleAndYear', 'layout', ['statistiques' => $statistiques, 'year' => $year]);
    }

    public function getStatsForCategories() {
        $categorie;
        if(isset($_POST) && empty($_POST)){
            $categorie = "";
        }
        else{
            $categorie = $_POST['selectCategorie'];
        }

        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForCategoriesAndMonth();

        for($i=0; $i<count($statistiques); $i++){
            $explodeDate=explode("-", $statistiques[$i]['mois']);
            $month = ["Janvier", "Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre"];
            $date = $month[intval($explodeDate[1])-1]." ".$explodeDate[0];
            $statistiques[$i]["newDate"]=$date;
        }

        $this->render('statistics/displayStatsForCategory', 'layout', ['statistiques' => $statistiques, 'categorie' => $categorie]);
    }

    public function getAllStatistiquesForCategoriesAndDay() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForCategoriesAndDay();

        for($i=0; $i<count($statistiques); $i++){
            $explodeDate=explode("-", $statistiques[$i]['jour']);
            $month = ["Janvier", "Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre"];
            $date = $explodeDate[2]." ".$month[intval($explodeDate[1])-1]." ".$explodeDate[0];
            $statistiques[$i]["newDate"]=$date;
        }

        $this->render('statistics/displayStatsForCategorieByDay ', 'layout', [    'statistiques'       => $statistiques]);
    }

    public function getAllStatistiquesForCategoriesAndMonth() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForCategoriesAndMonth();

        for($i=0; $i<count($statistiques); $i++){
            $explodeDate=explode("-", $statistiques[$i]['mois']);
            $month = ["Janvier", "Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre"];
            $date = $month[intval($explodeDate[1])-1]." ".$explodeDate[0];
            $statistiques[$i]["newDate"]=$date;
        }

        $this->render('statistics/displayStatsForCategorieByMonth', 'layout', [    'statistiques'       => $statistiques]);
    }

    public function getAllStatistiquesForCategoriesAndYear() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForCategoriesAndYear();

        $this->render('statistics/displayStatsForCategorieByYear', 'layout', [    'statistiques'       => $statistiques]);
    }

    public function getAllStatistiquesForArticleAndDay() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForArticleAndDay();

        for($i=0; $i<count($statistiques); $i++){
            $explodeDate=explode("-", $statistiques[$i]['date']);
            $month = ["Janvier", "Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre"];
            $date = $explodeDate[2]." ".$month[intval($explodeDate[1])-1]." ".$explodeDate[0];
            $statistiques[$i]["newDate"]=$date;
        }

        $this->render('statistics/displayStatsForArticleByDay', 'layout', [    'statistiques'       => $statistiques]);
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

        if(!isset($_GET['day']) && !isset($_POST['date'])){
            $date           = date("Y-m-d", time());

            $model          = new StatistiquesManager();
            $statistiques   = $model->getStatistiquesByOneDay($date);
            
            // Enregistrement de la page précédente pour le bouton retour
            $_SESSION['previousPage'] = 'statistics';

            $this->render('statistics/displayStatistiquesByOneDay', 'layout', ['statistiques' => $statistiques, 'date' => $date]);
        }
        elseif(!isset($_GET['day']) && isset($_POST['date'])){
            $date           = $_POST['date'];
            $model          = new StatistiquesManager();
            $statistiques   = $model->getStatistiquesByOneDay($date);
        
            // Enregistrement de la page précédente pour le bouton retour
            $_SESSION['previousPage'] = 'statistics';

            $this->render('statistics/displayStatistiquesByOneDay', 'layout', ['statistiques' => $statistiques, 'date' => $date]);
        }
        elseif(isset($_GET['day']) && !isset($_POST['date'])){
            $date           = $_GET['day'];
            $model          = new StatistiquesManager();
            $statistiques   = $model->getStatistiquesByOneDay($date);
            
            // Enregistrement de la page précédente pour le bouton retour
            $_SESSION['previousPage'] = 'getStatsForDay';
        
            $this->render('statistics/displayStatistiquesByOneDay', 'layout', ['statistiques' => $statistiques, 'date' => $date]);
        }
    }

    public function getAllStatistiquesForArticleAndMonth() {
        $model          = new StatistiquesManager();
        $statistiques   = $model->getAllStatistiquesForArticleAndMonth();

        for($i=0; $i<count($statistiques); $i++){
            $explodeDate=explode("-", $statistiques[$i]['mois']);
            $month = ["Janvier", "Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre"];
            $date = $month[intval($explodeDate[1])-1]." ".$explodeDate[0];
            $statistiques[$i]["newDate"]=$date;
        }

        $this->render('statistics/displayStatsForArticleByMonth', 'layout', [    'statistiques'       => $statistiques]);
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