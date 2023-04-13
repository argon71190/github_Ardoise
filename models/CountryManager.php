<?php

namespace Models;

class CountryManager extends Database {

    public function getCountries(): array {
        $query = $this->getDb()->prepare("SELECT * FROM `country`");
        $query->execute();
        $countries = $query->fetchAll();

        return $countries;
    }
}
