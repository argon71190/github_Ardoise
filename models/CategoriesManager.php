<?php

namespace Models;

use \Models\Database;

class CategoriesManager extends Database
{
    public function getCategories() {
        return $this->getAll('SELECT * FROM categories WHERE activate = 1 ORDER BY name ASC'); // WHERE activate = 1
    }
    public function getCategoriesCondiments() {
        return $this->getAll('SELECT name FROM catCondiments ORDER BY id ASC'); // WHERE activate = 1
    }
    public function getColumns($table) {
        $columnsNames = $this->getColumnNames($table, true);
        return $columnsNames;
    }
    public function getAllCategories() {
        return $this->getAll("SELECT * FROM categories ORDER BY id ASC");
    }

    public function getAllIdOffCategories() {
        return $this->getAll("SELECT id FROM categories ORDER BY id ASC");
    }

    public function selectOne($categorie) {
        $sql = 'SELECT * FROM categories WHERE name = ?';
        return $this->getOne($sql, [$categorie]);
    }

    public function selectPictureCatById($categorie) {
        $sql = 'SELECT picture FROM categories WHERE id = ?';
        return $this->getOne($sql, [$categorie]);
    }

    // *** AJOUTER UN ARTICLE
    public function insert(Categories $categories): void{

        $datas = [
            'name'      => $categories->getName(),
            'picture'   => $categories->getPicture(),
            'activate'  => $categories->getActivate()
        ];

        $this->addOne('categories', $datas);
    }

    // *** MODIFICATION DE L'ETAT DE LA CATEGORIE
    public function update(Categories $categories): void{

        $newData = [
            'activate'  => $categories->getActivate()
        ];

        $this->updateOne('categories', $newData, 'id', $categories->getId());
    }

    // *** SUPPRESSION DE LA CATEGORIE
    public function deleteCategorie($id) {
        $this->deleteOne('categories', 'id', $id);
    }






/*
    public function addCategory( $data )
    {
        $this->addOne( 'categories', $data );
    }
    */
}