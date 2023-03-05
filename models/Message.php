<?php

namespace Models;

class Message extends Database
{
    public function getRoomMessagesOrderByDateAsc( $roomId )
    {
        $query = $this->getDb()->prepare( "SELECT * FROM messages WHERE room_id = ? ORDER BY created_at ASC" );
        $query->execute( [ $roomId ] );
        return $query->fetchAll();
    }
    
    public function addMessage( $data )
    {
        $this->addOne( 'messages', $data );
    }
}