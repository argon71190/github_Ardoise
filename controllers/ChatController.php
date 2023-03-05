<?php

namespace Controllers;

use \App\Router;
use \Models\Category;
use \Models\Room;
use \Models\Message;

class ChatController extends Router
{
    public function addCategory() {
        try {
            if( isset( $_POST['name'] ) && !empty( $_POST['name'] ) ) {
                if( strlen( $_POST['name'] ) <= 50 ) {
                    $categoryModel = new Category();
                    $categoryModel->addCategory( $_POST );
                    $this->redirectToRoute( 'chats' );
                }
                else {
                    throw new \Exception('Le nom de catégorie est limité à 65 caractères');
                }
            }
            else {
                throw new \Exception('Merci de renseigner un nom de catégorie.');
            }
        }
        catch(\Exception $e) {
            $errorMsg = $e->getMessage();
            $this->redirectToRoute(
                'new-category',
                ['error' => $errorMsg]
            );
        }
    }

    public function addRoom() {
        try {
            if( isset( $_POST['name'] ) && !empty( $_POST['name'] ) &&
                    isset( $_POST['category_id'] ) && !empty( $_POST['category_id'] ) ) {
                $categoryModel = new Category();
                $category = $categoryModel->getCategoryById( $_POST['category_id'] );

                if( $category ) {
                    if( strlen( $_POST['name'] ) <= 65 ) {
                        $roomModel = new Room();
                        $roomModel->addRoom( $_POST );
                        $this->redirectToRoute( 'chats' );
                    }
                    else {
                        throw new \Exception('Le nom du salon est limité à 65 caractères.');
                    }
                }
                else {
                    throw new \Exception('La catégorie est inconnue.');
                }
            }
            else {
                throw new \Exception('Merci de renseigner un nom de salon.');
            }
        }
        catch(\Exception $e) {
            $errorMsg = $e->getMessage();
            $this->redirectToRoute(
                'new-room',
                ['error' => $errorMsg]
            );
        }
    }

    public function addMessage() {
        try {
            if( isset( $_POST['content'] ) && !empty( $_POST['content'] ) &&
                    isset( $_POST['room_id'] ) && !empty( $_POST['room_id'] ) ) {
                $roomModel = new Room();
                $room = $roomModel->getRoomById( $_POST['room_id'] );
                if( $room ) {
                    if( strlen( $_POST['name'] ) <= 65 ) {
                        $messageModel = new Message();
                        $messageModel->addMessage( $_POST );
                        $this->redirectToRoute( 'chats', [
                            'roomid' => $_POST['room_id']
                        ]);
                    }
                    else {
                        throw new \Exception('Le nom du salon est limité à 65 caractères.');
                    }
                }
                else {
                    throw new \Exception('Le salon est inconnu.');
                }
            }
            else {
                throw new \Exception('L\'envoi de message vide est impossible.');
            }
        }
        catch(\Exception $e) {
            $errorMsg = $e->getMessage();
            $this->redirectToRoute(
                'chats',
                ['error' => $errorMsg]
            );
        }
    }
}