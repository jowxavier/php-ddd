<?php

namespace App\DomainDrivenDesign\Domain\Product\Entities;

use DomainException;

class Product
{
    public function __construct(
        private string $id, 
        private string $name,
        private float $price
    )
    {
        $this->validate();
    }

    public function getId() 
    {
        return $this->id;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getPrice() 
    {
        return $this->price;
    }

    public function changePrice(float $price): void
    {
        $this->price = $price;
        $this->validate();
    }

    private function validate() 
    {
        if (empty($this->name)) {
            throw new DomainException('Name is not valid.');
        }

        if (empty($this->price)) {
            throw new DomainException('Price is not valid.');
        }
    }
}

