<?php

namespace Models;

class Tva {

    private $id;
    private $name;
    private $value;

    // Getter and setteur : id
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    // Getter and setteur : name
    public function getName(): ?string {
        return htmlspecialchars($this->name);
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    // Getter and setteur : value
    public function getValue(): ?string {
        return htmlspecialchars($this->value);
    }

    public function setValue(?string $value): void {
        $this->value = $value;
    }
}