<?php

namespace App\DomainDrivenDesign\Domain\Customer\Entities;

class Customer
{
    private string $name;
    private string $email; 

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): Customer
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): Customer
    {
        $this->email = $email;

        return $this;
    }
}

