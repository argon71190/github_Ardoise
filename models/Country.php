<?php

namespace Models;

class Country {

    private $id;
    private $name;

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }


    public function getName(): ?string {
        return htmlspecialchars($this->name);
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }
}