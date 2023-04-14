<?php

namespace Models;

class OptionsManager extends Database {

    // Récupérer toutes les options
    public function getOptions() {
        return $this->getAll('articlesOptionsListing');
    }

    public function getAllCategories() {
        $sql = "SELECT id, name FROM catCondiments";
        return $this->getAll($sql);
        
    }

    // Récupérer toutes les options en fonction d'une catégorie de condiments
    public function getAllOptions() {
        $sql = "SELECT * FROM articlesOptionsListing WHERE categoriesCondiments_id = ? ORDER BY name ASC";
        return $this->getAll($sql, [$categoryId]);
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

    public function getOptionsLink( $articleId ) {
        $sql = "SELECT id, articlesOptionsListing_id FROM articlesOptions WHERE articles_id = ?";
        return $this->getAll($sql, [$articleId]);
    }

    // *** AJOUTER UN LIEN ARTICLE -> OPTION
    public function addLink($newLink) {
        $this->addOne('articlesOptions', $newLink);
    }
    

}