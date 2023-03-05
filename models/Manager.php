<?php

namespace Models;

//require_once '../configs/Database.php';

class Manager {

    protected \PDO $db;

    public function __construct(){

        $database = new Database();
        $this->db = $database->getConnection();
    }
}