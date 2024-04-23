<?php

namespace App\DomainDrivenDesign\Domain\Customer\Entities;

use App\DomainDrivenDesign\Domain\Customer\ValueObjects\Address;
use DomainException;

class Customer
{
    private int $id; 
    private string $name; 
    private Address $address; 
    private bool $active = false;

    public function __get($attribute) {
        return $this->$attribute;
    }

    public function __set($attribute, $value) {
        if ($attribute === 'active') {
            return false;
        }

        $this->$attribute = $value;
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

