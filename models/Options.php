<?php

namespace Models;

class Options {

    private $id;
    private $name;
    private $shortname;
    private $picture;
    private $price;
    private $categoriesCondiments_id;

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

    // Getter and setteur : shortname
    public function getShortname(): ?string {
        return htmlspecialchars($this->shortname);
    }

    public function setShortname(?string $shortname): void {
        $this->shortname = $shortname;
    }

    // Getter and setteur : picture
    public function getPicture(): ?string {
        return htmlspecialchars($this->picture);
    }

    public function setPicture(?string $picture): void {
        $this->picture = $picture;
    }

    // Getter and setteur : price
    public function getPrice(): ?string {
        return htmlspecialchars($this->price);
    }

    public function setPrice(?string $price): void {
        $this->price = $price;
    }

    // Getter and setteur : categorie_id
    public function getCategoriesCondiments_id(): ?string {
        return $this->categoriesCondiments_id;
    }

    public function setCategoriesCondiments_id(?string $categoriesCondiments_id): void {
        $this->categoriesCondiments_id = $categoriesCondiments_id;
    }

    
}