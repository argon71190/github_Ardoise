<?php

namespace Models;

class Orders extends Database {

    private $id;
    private $paymentMethod_id;
    private $dateTaken;
    private $total;
    private $given;
    private $rendu;

    // Getter and setteur : id
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    // Getter and setteur : payementMethod_id
    public function getPaymentMethod_id(): ?string {
        return htmlspecialchars($this->paymentMethod_id);
    }

    public function setPaymentMethod_id(?string $paymentMethod_id): void {
        $this->paymentMethod_id = $paymentMethod_id;
    }

    // Getter and setteur : dateTaken
    public function getDateTaken(): ?string {
        return htmlspecialchars($this->dateTaken);
    }

    public function setDateTaken(?string $dateTaken): void {
        $this->dateTaken = $dateTaken;
    }

    // Getter and setteur : total
    public function getTotal(): ?string {
        return htmlspecialchars($this->total);
    }

    public function setTotal(?string $total): void {
        $this->total = $total;
    }

    // Getter and setteur : given
    public function getGiven(): ?string {
        return htmlspecialchars($this->given);
    }

    public function setGiven(?string $given): void {
        $this->given = $given;
    }

    // Getter and setteur : rendu
    public function getRendu(): ?string {
        return htmlspecialchars($this->rendu);
    }

    public function setRendu(?string $rendu): void {
        $this->rendu = $rendu;
    }
}
