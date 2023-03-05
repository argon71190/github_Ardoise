<?php

namespace Models;

class TvaDetails {

    private $id;
    private $name;
    private $value;

    /**
     * Set the value of id
     */
    public function setId(?int $id) {
        $this->id = $id;
    }

    /**
     * Get the value of id
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * Set the value of name
     */
    public function setName(?string $name) {
        $this->name = $name;
    }

    /**
     * Get the value of name
     */
    public function getName():?string {
        return $this->name;
    }

    /**
     * Set the value of value
     */
    public function setValue(?float $value) {
        $this->value = $value;
    }

    /**
     * Get the value of value
     */
    public function getValue(): ?float {
        return $this->value;
    }
}