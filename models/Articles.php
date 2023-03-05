<?php

namespace Models;

class Articles {

    private $id;
    private $name;
    private $shortname;
    private $picture;
    private $price;
    private $categorie_id;
    private $tva_spl;
    private $tva_emp;
    private $codebarre;
    private $activate;
    private $screen_id;

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
    public function getCategorie_id(): ?string {
        return $this->categorie_id;
    }

    public function setCategorie_id(?string $categorie_id): void {
        $this->categorie_id = $categorie_id;
    }

    // Getter and setteur : tva_spl
    public function getTva_spl(): ?string {
        return $this->tva_spl;
    }

    public function setTva_spl(?string $tva_spl): void {
        $this->tva_spl = $tva_spl;
    }

    // Getter and setteur : tva_emp
    public function getTva_emp(): ?string {
        return $this->tva_emp;
    }

    public function setTva_emp(?string $tva_emp): void {
        $this->tva_emp = $tva_emp;
    }

    // Getter and setteur : codebarre
    public function getCodebarre(): ?string {
        return $this->codebarre;
    }

    public function setCodebarre(?string $codebarre): void {
        $this->codebarre = $codebarre;
    }

    // Getter and setteur : activate
    public function getActivate(): ?int {
        return htmlspecialchars($this->activate);
    }

    public function setActivate(?int $activate): void {
        $this->activate = $activate;
    }

    // Getter and setteur : screen_id
    public function getScreen_id(): ?string {
        return htmlspecialchars($this->screen_id);
    }

    public function setScreen_id(?string $screen_id): void {
        $this->screen_id = $screen_id;
    }
}