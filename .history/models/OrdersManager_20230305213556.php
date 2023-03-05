<?php

namespace Models;
use DateTime;

class OrdersManager extends Database {


    public function insertOrder(Orders $Orders){

        $datas = [
            'paymentMethod_id'  => $Orders->getPaymentMethod_id(),
            'total'             => $Orders->getTotal(),
            'given'             => $Orders->getGiven(),
            'rendu'             => $Orders->getRendu()
        ];

        return $this->addOne('orders', $datas);
    }

    public function insertOrderDetails(OrdersDetails $OrdersDetails): void {

        $datas = [
            'orders_id'     => $OrdersDetails->getOrders_id(),
            'article_id'    => $OrdersDetails->getArticle_id(),
            'quantity'      => $OrdersDetails->getQuantity(),
            'unitary_price' => $OrdersDetails->getUnitary_price()
        ];

        $this->addOne('ordersDetails', $datas);
    }









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

    public function setInterval(string $dateFirst, string $dateLast) : array {
        $dateIn = new DateTime($dateFirst);
        $dateOut = new DateTime($dateLast);
        $interval = $dateIn->diff($dateOut);

        $years = ""; $months = ""; $days = "";
        $hours = ""; $minutes = ""; $seconds = "";
        $shortTime = ""; $simplyTime = ""; $text = "";
        $array = [ $interval->y, $interval->m, $interval->d, $interval->h, $interval->i, $interval->s ];
        $newArray = []; $int = []; $tab = []; $int = ["ans", "mois"];

        $interval->y != 0 ? $years = $interval->y." ans" : $years = "";
        $interval->m != 0 ? $months = $interval->m." mois" : $months = "";
        if($interval->d != 0) {
            $days=$interval->d." jour"; $interval->d!=1 ? $days=$days."s" : $days=$days;
        }

        $interval->y != 0 && $interval->m != 0 && $interval->d != 0 ? $shortTime = $years.", ".$months." et ".$days : "";
        $interval->y == 0 && $interval->m == 0 && $interval->d == 0 ? $shortTime = false : "";
        $interval->y != 0 && $interval->m == 0 && $interval->d == 0 ? $shortTime = $years : "";
        $interval->y == 0 && $interval->m != 0 && $interval->d == 0 ? $shortTime = $months : "";
        $interval->y == 0 && $interval->m == 0 && $interval->d != 0 ? $shortTime = $days : "";
        $interval->y != 0 && $interval->m != 0 && $interval->d == 0 ? $shortTime = $years." et ".$months : "";
        $interval->y == 0 && $interval->m != 0 && $interval->d != 0 ? $shortTime = $months." et ".$days : "";
        $interval->y != 0 && $interval->m == 0 && $interval->d != 0 ? $shortTime = $years." et ".$days : "";

        if($interval->h != 0) {
            $hours=$interval->h." heure"; $interval->h!=1 ? $hours=$hours."s" : $hours=$hours;
        }
        if($interval->i != 0) {
            $minutes=$interval->i." minute"; $interval->i!=1 ? $minutes=$minutes."s" : $minutes=$minutes;
        }
        if($interval->s != 0) {
            $seconds=$interval->s." seconde"; $interval->s!=1 ? $seconds=$seconds."s" : $seconds=$seconds;
        }

        $interval->h != 0 && $interval->i == 0 && $interval->s == 0 ? $simplyTime = $hours : "";
        $interval->h == 0 && $interval->i != 0 && $interval->s == 0 ? $simplyTime = $minutes : "";
        $interval->h == 0 && $interval->i == 0 && $interval->s != 0 ? $simplyTime = $seconds : "";
        $interval->h != 0 && $interval->i != 0 && $interval->s != 0 ? $simplyTime = $hours.", ".$minutes." et ".$seconds : "";
        $interval->h == 0 && $interval->i == 0 && $interval->s == 0 ? $simplyTime = false : "";
        $interval->h != 0 && $interval->i != 0 && $interval->s == 0 ? $simplyTime = $hours." et ".$minutes : "";
        $interval->h == 0 && $interval->i != 0 && $interval->s != 0 ? $simplyTime = $minutes." et ".$seconds : "";
        $interval->h != 0 && $interval->i == 0 && $interval->s != 0 ? $simplyTime = $hours." et ".$seconds : "";

        for($i=0; $i<=count($array); $i++) {
            switch($i){
                case 2: $array[2] > 1 ? $int[] = "jours"    : $int[] = "jour";      break;
                case 3: $array[3] > 1 ? $int[] = "heures"   : $int[] = "heure";     break;
                case 4: $array[4] > 1 ? $int[] = "minutes"  : $int[] = "minute";    break;
                case 5: $array[5] > 1 ? $int[] = "secondes" : $int[] = "seconde";   break;
                default: break;
            }
        }
        for($i=0; $i<count($array); $i++) {
            $array[$i] != 0 || $array[$i] != "" ? $tab[] = $int[$i] : "";
            $array[$i] != 0 ? $newArray[] = $array[$i]." ".$int[$i] : "";
        }

        for($i=0; $i<count($newArray); $i++){
            $text = ($i == count($newArray)-1)
                ? $text." et " .$newArray[$i]
                : (($i == 0) ? $text = $text.$newArray[$i]
                    : $text = $text.", ".$newArray[$i]);
            }

        return $array = [
            'dateIn'        => $dateFirst,
            'dateOut'       => $dateLast,
            'years'         => $interval->y,
            'months'        => $interval->m,
            'days'          => $interval->d,
            'hours'         => $interval->h,
            'minutes'       => $interval->i,
            'secondes'      => $interval->s,
            'onlyMinutes'   => $interval->h*60+$interval->i,
            'onlySeconds'   => $interval->h*60*60 + $interval->i*60 + $interval->s,
            'fullMonths'    => $interval->y*12 + $interval->m,
            'fullDays'      => $interval->days,
            'fullHours'     => $interval->days*24,
            'fullMinutes'   => $interval->days*24*60,
            'fullSeconds'   => $interval->days*24*60*60 + $interval->h*60*60 + $interval->i*60 + $interval->s,
            'fullTime'      => $text,
            'shortTime'     => $interval->days ." jours : ".$shortTime,
            'simplyDay'     => $shortTime,
            'simplyTime'    => $simplyTime,
        ];
    }
}
