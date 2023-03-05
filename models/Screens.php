<?php

namespace Models;

use \Models\Database;

class Screens extends Database
{
    public function getAllScreens() {
        return $this->getAll("SELECT * FROM screens ORDER BY id ASC");
    }

    public function getColumns() {
        $columnsNames = $this->getColumnNames("screens", true);
        return $columnsNames;
    }


/*
    public function addCategory( $data )
    {
        $this->addOne( 'categories', $data );
    }
    */
}