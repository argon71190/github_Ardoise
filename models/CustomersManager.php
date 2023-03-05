<?php

namespace Models;

class CustomersManager extends Database {

    public function getCustomers(string $byColumn = '1' , string $values = "1", string $order = 'id DESC', int $limit = 500): array {
        $sql = 'SELECT
                    customers.id, customers.lastname, customers.firstname, customers.birthday, customers.email,
                    customers.password, customers.rfid, customersDetails.adress, customersDetails.cp,
                    customersDetails.city, customers.createdAt, customers.valids_id, valids.statut,
                    country.name AS pays,
                    roles.name AS `role`
                FROM `customers`
                LEFT JOIN customersDetails
                    ON customers.id = customersDetails.id
                LEFT JOIN country
                    ON country.id   = customersDetails.country_id
                INNER JOIN valids
                    ON valids.id    = customers.valids_id
                INNER JOIN roles
                    ON roles.id     = customers.roles_id
                WHERE ' . $byColumn . ' = ? ORDER BY customers.' . $order . ' LIMIT ' . $limit;
        return $this->getAll($sql, [$values]);

        //$sql = 'SELECT * FROM (SELECT 1,2,3,4,5,6,7,8,9,10,11 UNION SELECT * FROM customers)dbname;';
        //$sql = 'SELECT * from customers UNION SELECT 1,2,3,4,5,6,7,8,9,10,11';
        //$sql = "SELECT TABLE_SCHEMA, TABLE_NAME, TABLE_COLLATION, AUTO_INCREMENT FROM information_schema.tables where table_type='BASE TABLE'";
        //return $this->getAll($sql);
    }


    // *** DETAIL CUSTOMER
    public function selectOne($column, $value) {
        $sql = 'SELECT  customers.id, customers.lastname, customers.firstname, customers.birthday, customers.email,
                        customers.password, customers.rfid, customersDetails.adress, customersDetails.cp,
                        customersDetails.city, country.name AS pays,
                        customers.createdAt, customers.valids_id, valids.statut, valids.comment
                FROM `customers`
                INNER JOIN valids
                    ON valids.id    = customers.valids_id
                LEFT JOIN customersDetails
                    ON customers.id = customersDetails.id
                INNER JOIN country
                    ON country.id   = customersDetails.country_id
                WHERE customers.'.$column.' = ?';
        return $this->getOne($sql, [$value]);
    }


    // ********** ADMINISTRATION **********
        // *** AJOUTER
    public function insert(Customers $customers): void{

        $query = '
            INSERT INTO customers
                (lastname, firstname, birthday, email, password, valids_id, createdAt, role, rfid)
            VALUES
                (:lastname, :firstname, :birthday, :email, :password, :valids_id, :createdAt, :role, :rfid)';

        $datas = [
            'lastname'  => $customers->getLastname(),
            'firstname' => $customers->getFirstname(),
            'birthday'  => $customers->getBirthday(),
            'email'     => $customers->getEmail(),
            'password'  => $customers->getPassword(),
            'rfid'      => $customers->getRfid()
        ];

        $this->addOne('customers', $datas);


    }
        // *** LISTER
    /*public function selectAllForAdmin(): array {


        $query = $this->db->prepare("
            SELECT  id,
                    name
            FROM    arcs;
            ");

        $query->execute();

        $arcs = $query->fetchAll();

        return $arcs;
    }
        // *** MODIFIER
    public function update(Customers $customers): void {

        $query = $this->db->prepare("UPDATE customers SET firstname = :name,
                                                        firstname = :firstname,
                                                        birthday = :birthday,
                                                        email = :email,
                                                        password = :password,
                                                        valids_id = :valids_id,
                                                        createdAt = :createdAt,
                                                        role = :role,
                                                        rfid = :rfid,
                                                WHERE   id = :id
        ");

        $query->bindValue(':lastname',  $customers->getLastname());
        $query->bindValue(':firstname', $customers->getFirstname());
        $query->bindValue(':birthday',  $customers->getBirthday());
        $query->bindValue(':email',     $customers->getEmail());
        $query->bindValue(':password',  $customers->getPassword());
        $query->bindValue(':valids_id', $customers->getValids());
        $query->bindValue(':createdAt', $customers->getCreated_At());
        $query->bindValue(':role',      $customers->getRole());
        $query->bindValue(':rfid',      $customers->getRfid());
        $query->bindValue(':id',        $customers->getId());

        $query->execute();
    }*/
}