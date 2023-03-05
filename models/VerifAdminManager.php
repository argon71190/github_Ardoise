<?php

namespace Models;
const CLE="";

class VerifAdminManager {

    public function getVerifIfAdmin() {
        if(isset($_SESSION['user'.CLE]) && $_SESSION['user'.CLE]['role'] == 'ADMIN') {
            return true;
        }
        else {
            header('Location: index.php?route=connect');
            exit;
        }
    }
}