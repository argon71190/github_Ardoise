<?php

namespace Models;
use DateTime;

class OrdersManager extends Database {

    public function getCustomers(string $byColumn = '1' , string $values = "1", string $order = 'id DESC', int $limit = 500): array {
        $sql = 'SELECT
                    customers.id, customers.lastname, customers.firstname, customers.birthday, customers.email,
                    customers.password, customers.rfid, customersDetails.adress, customersDetails.cp,
                    customersDetails.city, country.name AS pays, customers.createdAt, customers.valids_id, valids.statut,
                    roles.name AS `role`
                FROM `customers`
                LEFT JOIN customersDetails
                    ON customers.id = customersDetails.id
                LEFT JOIN country
                    ON country.id = customersDetails.country_id
                INNER JOIN valids
                    ON valids.id = customers.valids_id
                INNER JOIN roles
                    ON roles.id = customers.roles_id
                WHERE ' . $byColumn . ' = ? ORDER BY customers.' . $order . ' LIMIT ' . $limit;
        return $this->getAll($sql, [$values]);
    }

    public function selectAll(): array {
        $query = $this->db->prepare("SELECT * FROM customers");
        $query->execute();
        $arcs = $query->fetchAll();
        return $arcs;
    }

    // *** DETAIL CUSTOMER
    public function selectOne($column, $value) {
        $sql = 'SELECT  customers.id, customers.lastname, customers.firstname, customers.birthday, customers.email,
                        customers.password, customers.rfid, customersDetails.adress, customersDetails.cp,
                        customersDetails.city, country.name AS pays,
                        customers.createdAt, customers.valids_id, valids.statut, valids.comment
                FROM `customers`
                INNER JOIN valids
                    ON valids.id = customers.valids_id
                LEFT JOIN customersDetails
                    ON customers.id = customersDetails.id
                INNER JOIN country
                    ON country.id = customersDetails.country_id
                WHERE customers.'.$column.' = ?';
        return $this->getOne($sql, [$value]);
    }


    // ********** ADMINISTRATION **********
        // *** AJOUTER
    public function insert(Customers $customers): void{

        $query = '
            INSERT INTO customers (lastname, firstname, birthday, email, password, valids_id, createdAt, role, rfid)
            VALUES (:lastname, :firstname, :birthday, :email, :password, :valids_id, :createdAt, :role, :rfid)
        ';

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
    public function selectAllForAdmin(): array {


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
    }

    public function setInterval(string $dateFirst, string $dateLast) : array {
        $dateIn = new DateTime($dateFirst);
        $dateOut = new DateTime($dateLast);
        $interval = $dateIn->diff($dateOut);

        $years = ""; $months = ""; $days = "";
        $hours = ""; $minutes = ""; $seconds = "";
        $shortTime = ""; $simplyTime = ""; $text = "";
        $array = [ $interval->y, $interval->m, $interval->d, $interval->h, $interval->i, $interval->s ];
        $newArray = []; $int = []; $tab = []; $int = ["ans", "mois"];

        $interval->y != 0 ? $years = $interval->y." ans" : $years = "";
        $interval->m != 0 ? $months = $interval->m." mois" : $months = "";
        if($interval->d != 0) {
            $days=$interval->d." jour"; $interval->d!=1 ? $days=$days."s" : $days=$days;
        }

        $interval->y != 0 && $interval->m != 0 && $interval->d != 0 ? $shortTime = $years.", ".$months." et ".$days : "";
        $interval->y == 0 && $interval->m == 0 && $interval->d == 0 ? $shortTime = false : "";
        $interval->y != 0 && $interval->m == 0 && $interval->d == 0 ? $shortTime = $years : "";
        $interval->y == 0 && $interval->m != 0 && $interval->d == 0 ? $shortTime = $months : "";
        $interval->y == 0 && $interval->m == 0 && $interval->d != 0 ? $shortTime = $days : "";
        $interval->y != 0 && $interval->m != 0 && $interval->d == 0 ? $shortTime = $years." et ".$months : "";
        $interval->y == 0 && $interval->m != 0 && $interval->d != 0 ? $shortTime = $months." et ".$days : "";
        $interval->y != 0 && $interval->m == 0 && $interval->d != 0 ? $shortTime = $years." et ".$days : "";

        if($interval->h != 0) {
            $hours=$interval->h." heure"; $interval->h!=1 ? $hours=$hours."s" : $hours=$hours;
        }
        if($interval->i != 0) {
            $minutes=$interval->i." minute"; $interval->i!=1 ? $minutes=$minutes."s" : $minutes=$minutes;
        }
        if($interval->s != 0) {
            $seconds=$interval->s." seconde"; $interval->s!=1 ? $seconds=$seconds."s" : $seconds=$seconds;
        }

        $interval->h != 0 && $interval->i == 0 && $interval->s == 0 ? $simplyTime = $hours : "";
        $interval->h == 0 && $interval->i != 0 && $interval->s == 0 ? $simplyTime = $minutes : "";
        $interval->h == 0 && $interval->i == 0 && $interval->s != 0 ? $simplyTime = $seconds : "";
        $interval->h != 0 && $interval->i != 0 && $interval->s != 0 ? $simplyTime = $hours.", ".$minutes." et ".$seconds : "";
        $interval->h == 0 && $interval->i == 0 && $interval->s == 0 ? $simplyTime = false : "";
        $interval->h != 0 && $interval->i != 0 && $interval->s == 0 ? $simplyTime = $hours." et ".$minutes : "";
        $interval->h == 0 && $interval->i != 0 && $interval->s != 0 ? $simplyTime = $minutes." et ".$seconds : "";
        $interval->h != 0 && $interval->i == 0 && $interval->s != 0 ? $simplyTime = $hours." et ".$seconds : "";

        for($i=0; $i<=count($array); $i++) {
            switch($i){
                case 2: $array[2] > 1 ? $int[] = "jours"    : $int[] = "jour";      break;
                case 3: $array[3] > 1 ? $int[] = "heures"   : $int[] = "heure";     break;
                case 4: $array[4] > 1 ? $int[] = "minutes"  : $int[] = "minute";    break;
                case 5: $array[5] > 1 ? $int[] = "secondes" : $int[] = "seconde";   break;
                default: break;
            }
        }
        for($i=0; $i<count($array); $i++) {
            $array[$i] != 0 || $array[$i] != "" ? $tab[] = $int[$i] : "";
            $array[$i] != 0 ? $newArray[] = $array[$i]." ".$int[$i] : "";
        }

        for($i=0; $i<count($newArray); $i++){
            $text = ($i == count($newArray)-1)
                ? $text." et " .$newArray[$i]
                : (($i == 0) ? $text = $text.$newArray[$i]
                    : $text = $text.", ".$newArray[$i]);
            }

        return $array = [
            'dateIn'        => $dateFirst,
            'dateOut'       => $dateLast,
            'years'         => $interval->y,
            'months'        => $interval->m,
            'days'          => $interval->d,
            'hours'         => $interval->h,
            'minutes'       => $interval->i,
            'secondes'      => $interval->s,
            'onlyMinutes'   => $interval->h*60+$interval->i,
            'onlySeconds'   => $interval->h*60*60 + $interval->i*60 + $interval->s,
            'fullMonths'    => $interval->y*12 + $interval->m,
            'fullDays'      => $interval->days,
            'fullHours'     => $interval->days*24,
            'fullMinutes'   => $interval->days*24*60,
            'fullSeconds'   => $interval->days*24*60*60 + $interval->h*60*60 + $interval->i*60 + $interval->s,
            'fullTime'      => $text,
            'shortTime'     => $interval->days ." jours : ".$shortTime,
            'simplyDay'     => $shortTime,
            'simplyTime'    => $simplyTime,
        ];
    }
}
