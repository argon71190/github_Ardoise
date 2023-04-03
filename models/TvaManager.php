<?php

namespace Models;

use \Models\Database;

class TvaManager extends Database
{
    public function getAllTva() {
        return $this->getAll('SELECT * FROM tva ORDER BY value ASC');
    }

    public function getColumns($table) {
        $columnsNames = $this->getColumnNames($table, true);
        return $columnsNames;
    }


    public function getAllIdOffTva() {
        return $this->getAll("SELECT id FROM tva ORDER BY id ASC");
    }

    public function selectOne($tvaName) {
        $sql = 'SELECT * FROM tva WHERE name = ?';
        return $this->getOne($sql, [$tvaName]);
    }

    // *** AJOUTER UNE TVA
    public function insert(Tva $Tva): void{

        $datas = [
            'id'    => $Tva->getid(),
            'name'  => $Tva->getName(),
            'value' => $Tva->getValue()
        ];

        $this->addOne('tva', $datas);
    }

    // *** MODIFICATION DE L'ETAT DE LA CATEGORIE
    public function update(Tva $tva): void{

        $newData = [
            'activate'  => $tva->getActivate()
        ];

        $this->updateOne('tva', $newData, 'id', $tva->getId());
    }


    // *** SUPPRESSION DE LA CATEGORIE
    public function deleteTva($id) {
        $this->deleteOne('tva', 'id', $id);
    }




}