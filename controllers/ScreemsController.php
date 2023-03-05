<?php

namespace Controllers;

use \App\Router;
use \Models\CategoriesManager;
use \Models\Orders;
use \Models\ResultsManager;

class ScreemsController extends Router
{
    public function displayScreens() {

        $screen = "Cuisine";

        if(!isset($_SESSION['screen'])) {
            $_SESSION['screen'] = 'Cuisine';
        } else {
            $screen = $_SESSION['screen'];
        }

        $selectArtScreen = "1";
        if($screen == "Cuisine") {
            $selectArtScreen = "orders.art_screen_1";
        } else if($screen == "Bar"){
            $selectArtScreen = "orders.art_screen_2";
        } else {

        }

        $model  = new Orders();
        $orders = $model->getOrders($selectArtScreen, 'LIMIT 5');

        $ordersCount = $model->getOrders($selectArtScreen);
        $attente = count($ordersCount);

        $screens = $model->getScreens();

        $tab = [];
        foreach($orders as $order) {
            $orderDetails = $model->getOrderDetails($order['id'], $screen);
            $tab[] = $orderDetails;
            //var_dump($orderDetails);
        }
        $findDate   = new ResultsManager();
        $date       = $findDate->dateNow('Y-m-d','Europe/Paris');

        // Récupération de toutes les commandes du jour en état terminer pour calculer le temps d'attente
        $ordersTimes = $model->getOrdersEnd($date);

        $countOrders = 1;
        if(count($ordersTimes) != 0) {
            $countOrders = count($ordersTimes);
        }

        $timeMax = 0;
        $timeMin = 99999999999;
        $timeCalcul = 0;

        foreach($ordersTimes as $time) {
            $times[] = strtotime($time['time']);
            $timeCalcul += strtotime($time['time']);

            if(strtotime($time['time']) > $timeMax)
                $timeMax = strtotime($time['time']);

            if(strtotime($time['time']) < $timeMin)
                $timeMin = strtotime($time['time']);
        }

        $timeMaxi = date("H:i:s", $timeMax);
        $timeMini = date("H:i:s", $timeMin);
        $timeMoyen = date("H:i:s", $timeCalcul/$countOrders);

        if(count($ordersTimes) == 0) {
            $timeMoyen = "00:00:00";
            $timeMaxi = "00:00:00";
            $timeMini = "00:00:00";
        }

        $this->render('screens', 'layout', [
            'orders'        => $orders,
            'countOrders'   => $countOrders,
            'tab'           => $tab,
            'timeMin'       => $timeMini,
            'timeMax'       => $timeMaxi,
            'timeMoyen'     => $timeMoyen,
            'attente'       => $attente,
            'screen'        => $screen,
            'screens'       => $screens
        ]);
    }


    public function displayLaterOrderInScreens() {
        $_SESSION['screen'] = 'Tous';
        $screen = "Tous";

        // if(!isset($_SESSION['screen'])) {
        //     $_SESSION['screen'] = 'Cuisine';
        // } else {
        //     $screen = $_SESSION['screen'];
        // }

        $model  = new Orders();
        $orders = $model->getOrdersWithLater('LIMIT 5');

        $ordersCount = $model->getOrdersWithLater();
        $attente = count($ordersCount);

        $screens = $model->getScreens();

        $tab = [];
        foreach($orders as $order) {
            $orderDetails = $model->getOrderDetailsOrder($order['id']);
            $tab[] = $orderDetails;
        }

        $findDate   = new ResultsManager();
        $date       = $findDate->dateNow('Y-m-d','Europe/Paris');

        // Récupération de toutes les commandes du jour en état terminer pour calculer le temps d'attente
        $ordersTimes = $model->getOrdersEnd($date);

        $countOrders = 1;
        if(count($ordersTimes) != 0) {
            $countOrders = count($ordersTimes);
        }

        $timeMax = 0;
        $timeMin = 99999999999;
        $timeCalcul = 0;

        foreach($ordersTimes as $time) {
            $times[] = strtotime($time['time']);
            $timeCalcul += strtotime($time['time']);

            if(strtotime($time['time']) > $timeMax)
                $timeMax = strtotime($time['time']);

            if(strtotime($time['time']) < $timeMin)
                $timeMin = strtotime($time['time']);
        }

        $timeMaxi = date("H:i:s", $timeMax);
        $timeMini = date("H:i:s", $timeMin);
        $timeMoyen = date("H:i:s", $timeCalcul/$countOrders);

        if(count($ordersTimes) == 0) {
            $timeMoyen = "00:00:00";
            $timeMaxi = "00:00:00";
            $timeMini = "00:00:00";
        }

        $this->render('laterScreens', 'layout', [
            'orders'        => $orders,
            'countOrders'   => $countOrders,
            'tab'           => $tab,
            'timeMin'       => $timeMini,
            'timeMax'       => $timeMaxi,
            'timeMoyen'     => $timeMoyen,
            'attente'       => $attente,
            'screen'        => $screen,
            'screens'       => $screens
        ]);
    }


    public function updateDateStartOrder(int $id) {
        $model   = new Orders();
        $model->setDateStartOrder($id);

        header('Location: index.php?route=screens');
        exit();
    }


    public function updateDateEndOrder(int $id) {
        $model   = new Orders();
        $model->setDateEndOrder($id);

        header('Location: index.php?route=screens');
        exit();
    }

    public function displayCategories() {
        $model      = new CategoriesManager();
        $categories = $model->getCategories();

        $this->render('categories', 'layout', ['categories' => $categories]);
    }

    // METHODE PERMETTANT D'AFFICHER LES COMMANDES EN ATTENTE DE REGLEMENT
    public function displayStandByOrders() {
        $model   = new Orders();
        $orders = $model->getStandByOrders();
        if(count($orders) > 1)
            $attente = count($orders)." commandes";
        else
            $attente = count($orders)." commande";

        $tab = [];
        foreach($orders as $order) {
            $orderDetails = $model->getOrderDetailsOrder($order['id']);
            $tab[] = $orderDetails;
        }
        // var_dump($orders);

        $this->render('standByOrders', 'layout', ['orders' => $orders, "attente" => $attente, "tab" => $tab]);
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