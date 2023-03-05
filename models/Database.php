<?php

namespace Models;

abstract class Database {

    private static $_dbConnect;

    private static function setDb() {
        self::$_dbConnect = new \PDO( 'mysql:host=db.3wa.io;dbname=argon71hotmailfr_ardoise;charset=utf8', 'argon71hotmailfr', '1b6d9c41e962f51b032b2fbc3a06cba1');
        self::$_dbConnect->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING );
    }

    protected function getDb() {
        if( self::$_dbConnect == null ) {
            self::setDb();
        }
        return self::$_dbConnect;
    }

    protected function getAll( string $sql, array $values = [] ): array {
        $query = $this->getDb()->prepare($sql);
        $query->execute($values);
        return $query->fetchAll();
    }

    protected function getOne(string $sql, array $values = [] ){
        $query = $this->getDb()->prepare($sql);
        $query->execute($values);
        return $query->fetch();
    }

    protected function addOne(string $table, array $datas): void {
        $columns = '';
        $values = '';
        foreach( $datas as $key => $value ) {
            $columns .= $key . ',';
            $values .= '?,';
        }
        $columns = substr( $columns, 0, -1 );
        $values = substr( $values, 0, -1 );
        $dataToAdd = [];
        foreach( $datas as $key => $value ) {
            $dataToAdd[] = $value;
        }
        $query = $this->getDb()->prepare("INSERT INTO $table ( $columns ) VALUES ( $values )");
        $query->execute( $dataToAdd );
        //return $this->getDb()->lastInsertId();
    }

    protected function getColumnNames(string $table, bool $withId = false) : array {
        $query = $this->getDb()->prepare("DESCRIBE " . $table);
        $query->execute();
        $table_fields = $query->fetchAll($this->getDb()::FETCH_COLUMN);
        $stringFields = '';
        $params = '';

        foreach($table_fields as $field) {
            if($withId == false) {
                if($field != 'id') {
                    $stringFields .= $field . ', ';
                    $params .= '?, ';
                }
            }else {
                $stringFields .= $field . ', ';
                $params .= '?, ';
            }
        }

        $columns = substr($stringFields, 0, -2);
        $fictifsParams = substr($params, 0, -2);

        return [$columns, $fictifsParams];
    }

    protected function upadateDateStartOrders(string $column, int $id) {
        $query = $this->getDb()->prepare("UPDATE `orders` SET $column = NOW() WHERE `orders`.`id` = ?" );
        $query->execute([$id]);
    }

    protected function upadateDateEndOrders(string $column, int $id) {
        $query = $this->getDb()->prepare("UPDATE `orders` SET $column = NOW(), `finalStatut` = '1' WHERE `orders`.`id` = ?" );
        $query->execute([$id]);
    }

    protected function getAllBy( $table, $condition, $conditionValue ) {
        $query = $this->getDb()->prepare("SELECT * FROM $table WHERE $condition = ?");
        $query->execute( [ $conditionValue ] );
        return $query->fetchAll();
    }

    protected function updateOne( $table, $newData, $condition, $uniq ) {
        $sets = '';

        foreach( $newData as $key => $value ) {
            $sets .= "$key = :$key,";
        }

        $sets = substr( $sets, 0, -1 );
        $query = $this->getDb()->prepare("UPDATE $table SET $sets WHERE $condition = :$condition");

        foreach( $newData as $key => $value ) {
            $query->bindvalue( ":$key", $value );
        }

        $query->bindvalue( ":$condition", $uniq );
        $query->execute();
    }

    protected function deleteOne($table, $condition, $value) {
        $query = $this->getDb()->prepare("DELETE FROM " . $table . " WHERE " . $condition . " = ?");
        $query->execute( [ $value ] );
        $query->closeCursor();
    }
}

