<?php

namespace Models;

class Categories {

    private $id;
    private $name;
    private $picture;
    private $activate;

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

    // Getter and setteur : picture
    public function getPicture(): ?string {
        return htmlspecialchars($this->picture);
    }

    public function setPicture(?string $picture): void {
        $this->picture = $picture;
    }

    // Getter and setteur : activate
    public function getActivate(): ?int {
        return htmlspecialchars($this->activate);
    }

    public function setActivate(?int $activate): void {
        $this->activate = $activate;
    }
}