<?php

namespace App\DomainDrivenDesign\Domain\Order\Entities;

use DomainException;

class OrderItem
{
    public function __construct(
        private string $id,
        private string $productId, 
        private string $name,
        private float $price,
        private int $quantity
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

    private function validate() 
    {
        if (empty($this->name)) {
            throw new DomainException('Name is not valid.');
        }

        if (empty($this->price)) {
            throw new DomainException('Price is not valid.');
        }
    }

    public function total()
    {
        return $this->price * $this->quantity; 
    }
}

