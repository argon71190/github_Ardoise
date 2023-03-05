<?php

namespace Models;

class OrdersDetails {

    private $id;
    private $orders_id;
    private $article_id;
    private $quantity;
    private $unitary_price;

    // Getter and setteur : id
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    // Getter and setteur : orders_id
    public function getOrders_id(): ?string {
        return htmlspecialchars($this->orders_id);
    }

    public function setOrders_id(?string $orders_id): void {
        $this->orders_id = $orders_id;
    }

    // Getter and setteur : article_id
    public function getArticle_id(): ?string {
        return htmlspecialchars($this->article_id);
    }

    public function setArticle_id(?string $article_id): void {
        $this->article_id = $article_id;
    }

    // Getter and setteur : quantity
    public function getQuantity(): ?string {
        return htmlspecialchars($this->quantity);
    }

    public function setQuantity(?string $quantity): void {
        $this->quantity = $quantity;
    }

    // Getter and setteur : unitary_price
    public function getUnitary_price(): ?string {
        return htmlspecialchars($this->unitary_price);
    }

    public function setUnitary_price(?string $unitary_price): void {
        $this->unitary_price = $unitary_price;
    }
}