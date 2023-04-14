<?php

namespace Models;

class CustomersDetails {

    private ?int $id;
    private ?int $country;
    private ?int $customerId;
    private ?string $adress;
    private ?string $zipcode;
    private ?string $city;

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getCountry(): ?int {
        return is_null($this->country) ? null : htmlspecialchars($this->country);
    }

    public function setCountry(?int $country): void {
        $this->country = $country;
    }

    public function getCustomerId(): ?int {
        return is_null($this->customerId) ? null : htmlspecialchars($this->customerId);
    }

    public function setCustomerId(?int $customerId): void {
        $this->customerId = $customerId;
    }


    public function getAdress(): ?string {
        return is_null($this->adress) ? null : htmlspecialchars($this->adress, ENT_QUOTES);
    }

    public function setAdress(?string $adress): void {
        $this->adress = $adress;
    }


    public function getZipcode(): ?string {
        return is_null($this->zipcode) ? null : htmlspecialchars($this->zipcode);
    }

    public function setZipcode(?string $zipcode): void {
        $this->zipcode = $zipcode;
    }


    public function getCity(): ?string {
        return $this->city;
    }

    public function setCity(?string $city): void {
        $this->city = $city;
    }
}
