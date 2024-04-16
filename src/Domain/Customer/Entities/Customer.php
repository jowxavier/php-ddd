<?php

namespace App\DomainDrivenDesign\Domain\Customer\Entities;

use App\DomainDrivenDesign\Domain\Customer\ValueObjects\Address;
use DomainException;

class Customer
{
    public function __construct(
        private string $id, 
        private string $name, 
        private Address $address, 
        private bool $active = false
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

    private function validate() 
    {
        if (empty($this->name)) {
            throw new DomainException('Name is not valid.');
        }
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
        $this->validate();
    }

    public function activate(): void
    {
        if (empty($this->address)) {
            throw new DomainException('Address is mandatory to activate customer.');
        }
        $this->active = true;
    }

    public function desactivate(): void
    {
        $this->active = false;
    }
}

