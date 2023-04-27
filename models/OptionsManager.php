<?php

namespace Models;

class OptionsManager extends Database {

    // Récupérer toutes les options
    public function getOptions() {
        return $this->getAll('articlesOptionsListing');
    }

    // Récupérer les catégories d'options
    public function getAllCategories() {
        $sql = "SELECT id, name FROM catCondiments";
        return $this->getAll($sql);
        
    }

    // Récupérer toutes les options en fonction d'une catégorie de condiments
    public function getAllOptions() {
        $sql = "SELECT * FROM articlesOptionsListing  ORDER BY name ASC";
        return $this->getAll($sql);
    }

    // Récupérer toutes les options en fonction d'une catégorie de condiments
    public function getAllOptionsByCat($categoryId ) {
        $sql = "SELECT * FROM articlesOptionsListing WHERE categoriesCondiments_id = ? ORDER BY name ASC";
        return $this->getAll($sql, [$categoryId]);
    }

    // Récupérer un article en fonction de son id
    public function getOptionById($id) {
        return $this->getOne('SELECT    id, name, categoriesCondiments_id, shortName, picture, price
                                FROM articlesOptionsListing
                                WHERE id = ?', [$id]);
    }

    // Récupérer l'ID de toutes les options
    public function getOptionsId(){
        $sql = "SELECT id FROM articlesOptionsListing  ORDER BY name ASC";
        return $this->getAll($sql);
    }

    

    // Ajouter une nouvelle option
    public function addOption( $data ) {
        $this->addOne( 'articlesOptionsListing', $data );
    }


    // *** AJOUTER UNE OPTION
    public function insert(Options $Options): void{

        $datas = [
            'name'          => $Options->getName(),
            'shortName'     => $Options->getShortName(),
            'picture'       => $Options->getPicture(),
            'price'         => $Options->getPrice(),
            'categoriesCondiments_id' => $Options->getCategoriesCondiments_id(),
            
        ];

        $this->addOne('articlesOptionsListing', $datas);
    }


    // Récupérer le lien entre un article et une option ( Table intermédiaire ) en fonction de l'ID d'un article
    public function getOptionsLink( $articleId ) {
        $sql = "SELECT id, articlesOptionsListing_id FROM articlesOptions WHERE articles_id = ?";
        return $this->getAll($sql, [$articleId]);
    }

    // *** AJOUTER UN LIEN ARTICLE -> OPTION
    public function addLink($newLink) {
        $this->addOne('articlesOptions', $newLink);
    }

    // SUPPRESSION D'UNE ASSOCIATION ARTICLE - OPTION
    public function deleteLink($articleId, $optionId){
        $query = $this->getDb()->prepare("DELETE FROM articlesOptions WHERE articles_id =". $articleId . " AND articlesOptionsListing_id =". $optionId);
        $query->execute();
        $query->closeCursor();
    }

    // CHARGER UNE ASSOCIATION AVEC L'ID DE L'ARTICLE AINSI QUE CELUI DE l'OPTION EN PARAMÈTRE
    public function loadLink($articleId, $optionId){
        $query = $this->getDb()->prepare("SELECT id FROM articlesOptions WHERE articles_id =". $articleId . " AND articlesOptionsListing_id =". $optionId);
        $query->execute();
        return $query->fetch();
    }
}