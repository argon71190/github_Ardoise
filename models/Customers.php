<?php

namespace Models;

class Customers {

    private $id;
    private $lastname;
    private $firstname;
    private $birthday;
    private $email;
    private $password;
    private $valids;
    private $created_At;
    private $role;
    private $rfid;

    // Getter and setteur : id
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    // Getter and setteur : lastname
    public function getLastname(): ?string {
        return htmlspecialchars($this->lastname);
    }

    public function setLastname(?string $lastname): void {
        $this->lastname = $lastname;
    }

    // Getter and setteur : firstname
    public function getFirstname(): ?string {
        return htmlspecialchars($this->firstname);
    }

    public function setFirstname(?string $firstname): void {
        $this->firstname = $firstname;
    }

    // Getter and setteur : birthday
    public function getBirthday(): ?string {
        return htmlspecialchars($this->birthday);
    }

    public function setBirthday(?string $birthday): void {
        $this->birthday = $birthday;
    }

    // Getter and setteur : email
    public function getEmail(): ?string {
        return htmlspecialchars($this->email);
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    // Getter and setteur : password
    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): void {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    // Getter and setteur : valids
    public function getValids(): ?string {
        return $this->valids;
    }

    public function setValids(?string $valids): void {
        $this->valids = $valids;
    }

    // Getter and setteur : created_at
    public function getCreated_At(): ?string {
        return $this->created_At;
    }

    public function setCreated_At(?string $created_At): void {
        $this->created_At = $created_At;
    }

    // Getter and setteur : role
    public function getRole(): ?string {
        return $this->role;
    }

    public function setRole(?string $role): void {
        $this->role = $role;
    }

    // Getter and setteur : rfid
    public function getRfid(): ?string {
        return htmlspecialchars($this->rfid);
    }

    public function setRfid(?string $rfid): void {
        $this->rfid = $rfid;
    }
}