<?php

namespace Controllers;

use \App\Router;
use \Models\Category;
use \Models\CustomersManager;
use \Models\Room;
use \Models\Message;

class FrontController extends Router
{
    public function displayHome() {
        $model      = new CustomersManager();
        $customers  = $model->getCustomers();
        //var_dump($customers);

        $this->render( 'home', 'layout' );
    }













/*

    public function displayChats() {
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

    public function displayCategoryForm() {
        $this->render( 'newCategory', 'layout' );
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