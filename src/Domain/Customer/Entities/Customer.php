<?php

namespace App\DomainDrivenDesign\Domain\Customer\Entities;

use DomainException;

class Customer
{
    public function __construct(
        private string $name, 
        private string $address, 
        private bool $active = false
    )
    {
        $this->validate();
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

