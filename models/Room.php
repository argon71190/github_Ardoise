<?php

namespace Models;

class Room extends Database
{
    public function getRooms()
    {
        return $this->getAll('rooms');
    }

    public function getRoomsByCat( $catId )
    {
        return $this->getAllBy( 'rooms', 'category_id', $catId );
    }

    public function getRoomById( $roomId )
    {
        return $this->getOne( 'rooms', 'id', $roomId );
    }

    public function addRoom( $data )
    {
        $this->addOne( 'rooms', $data );
    }
}