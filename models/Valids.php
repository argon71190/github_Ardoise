<?php

namespace Models;

class Valids {

    private $id;
    private $statut;
    private $comment;

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }


    public function getStatut(): ?string {
        return htmlspecialchars($this->statut);
    }

    public function setStatut(?string $statut): void {
        $this->statut = $statut;
    }


    public function getComment(): ?string {
        return htmlspecialchars($this->comment);
    }

    public function setComment(?string $comment): void {
        $this->comment = $comment;
    }
}