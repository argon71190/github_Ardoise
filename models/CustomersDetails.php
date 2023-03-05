<?php

namespace Models;

class CustomersDetails {

    private $id;
    private $country;
    private $customerId;
    private $adress;
    private $cp;
    private $city;

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }


    public function getCountry(): ?int {
        return htmlspecialchars($this->country);
    }

    public function setCountry(?int $country): void {
        $this->country = $country;
    }


    public function getCustomerId(): ?int {
        return htmlspecialchars($this->customerId);
    }

    public function setCustomerId(?int $customerId): void {
        $this->customerId = $customerId;
    }


    public function getAdress(): ?string {
        return htmlspecialchars($this->adress);
    }

    public function setAdress(?string $adress): void {
        $this->adress = $adress;
    }


    public function getCp(): ?string {
        return htmlspecialchars($this->cp);
    }

    public function setCp(?string $cp): void {
        $this->cp = $cp;
    }


    public function getCity(): ?string {
        return $this->city;
    }

    public function setCity(?string $city): void {
        $this->city = $city;
    }
}