<?php

namespace Models;

class ArticlesManager extends Database {

    // Récupérer tous les articles
    public function getArticles() {
        return $this->getAll('articles');
    }

    public function getArticlesId(){
        $sql = "SELECT id FROM articles  ORDER BY name ASC";
        return $this->getAll($sql);
    }

    // Récupérer tous les articles en fonction d'une catégorie précise
    public function getAllArticlesByCat($categoryId ) {
        $sql = "SELECT * FROM articles WHERE categories_id = ? ORDER BY name ASC";
        return $this->getAll($sql, [$categoryId]);
    }

    // Récupérer un article en fonction de son id
    public function getArticleById($id) {
        return $this->getOne('SELECT    articles.id, articles.name, articles.categories_id, articles.shortName, articles.picture,
                                        articles.price, articles.codebarre, articles.activate,
                                        categories.name AS `category`,
                                        a.name AS `tva_sur_place`,
                                        b.name AS `tva_a_emporter`,
                                        screens.name AS screen
                                FROM `articles`
                                INNER JOIN categories
                                    ON categories.id = articles.categories_id
                                INNER JOIN tva a
                                    ON a.id = articles.tva_spl
                                INNER JOIN tva b
                                    ON b.id = articles.tva_emp
                                INNER JOIN screens
                                    ON screens.id = articles.screen_id
                                WHERE articles.id = ?', [$id]);
    }

    // Récupérer toutes les options d'une article
    public function getAllOptionsOfArticle( $id ) {
        return $this->getAll( 'SELECT   articlesOptions.id AS article_id,
                                        articlesOptionsListing.name, articlesOptionsListing.price,
                                        articlesOptionsListing.picture, articlesOptionsListing.categoriesCondiments_id,
                                        articlesOptionsListing.shortName AS shortName,
                                        catCondiments.name AS categorie
                                FROM `articlesOptions`
                                INNER JOIN articlesOptionsListing
                                    ON articlesOptionsListing.id = articlesOptions.articlesOptionsListing_id
                                INNER JOIN catCondiments
                                    ON catCondiments.id = articlesOptionsListing.categoriesCondiments_id
                                WHERE articles_id = ?', [$id] );
    }

    // Ajouter un nouvel article
    public function addArticle( $data ) {
        $this->addOne( 'articles', $data );
    }

    // Ajouter un nouvel article
    public function findCodeBarre( $codeBarre ) {
        return $this->getOne('SELECT *
                                FROM `articles`
                                WHERE codebarre = ?', [$codeBarre]);
    }

    // *** AJOUTER UN ARTICLE
    public function insert(Articles $Articles): void{

        $datas = [
            'name'          => $Articles->getName(),
            'shortName'     => $Articles->getShortName(),
            'picture'       => $Articles->getPicture(),
            'price'         => $Articles->getPrice(),
            'categories_id' => $Articles->getCategorie_id(),
            'tva_spl'       => $Articles->getTva_spl(),
            'tva_emp'       => $Articles->getTva_emp(),
            'codebarre'     => $Articles->getCodebarre(),
            'activate'      => $Articles->getActivate(),
            'screen_id'     => $Articles->getScreen_id()
        ];

        $this->addOne('articles', $datas);
    }


    // UPDATE UN ARTICLE
    public function update(Articles $article): void {
        $query = $this->getDb()->prepare("UPDATE articles   SET     name = :name,
                                                                    shortName = :shortName,
                                                                    price = :price,
                                                                    picture = :picture,
                                                                    categories_id = :categories_id,
                                                                    tva_spl = :tva_spl,
                                                                    tva_emp = :tva_emp,
                                                                    codebarre = :codebarre,
                                                                    activate = :activate,
                                                                    screen_id = :screen_id
                                                            WHERE   id = :id");

        $query->bindValue(':name',              $article->getName());
        $query->bindValue(':shortName',         $article->getShortname());
        $query->bindValue(':price',             $article->getPrice());
        $query->bindValue(':picture',           $article->getPicture());
        $query->bindValue(':categories_id',     $article->getCategorie_id());
        $query->bindValue(':tva_spl',           $article->getTva_spl());
        $query->bindValue(':tva_emp',           $article->getTva_emp());
        $query->bindValue(':codebarre',         $article->getCodebarre());
        $query->bindValue(':activate',          $article->getActivate());
        $query->bindValue(':screen_id',         $article->getScreen_id());
        $query->bindValue(':id',                $article->getId());

        $query->execute();
    }

}
