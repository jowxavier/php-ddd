<?php

namespace App\DomainDrivenDesign\Domain\Customer\ValueObjects;

use DomainException;

final class Address
{
    public function __construct(
        private int $id,
        private string $street, 
        private string $number,
        private string $zipcode,
        private string $city,
        private string $state
    )
    {
        $this->validate();
    }

    public function __get($attribute) {
        return $this->$attribute;
    }

    private function validate()
    {
        if (empty($this->street)) {
            throw new DomainException('Street is not valid');
        }

        if (empty($this->number)) {
            throw new DomainException('Number is not valid');
        }

        if (empty($this->zipcode)) {
            throw new DomainException('Zip Code is not valid');
        }

        if (empty($this->city)) {
            throw new DomainException('City is not valid');
        }

        if (empty($this->state)) {
            throw new DomainException('State is not valid');
        }
    }

    public function __toString(): string
    {
        return "{$this->street}, {$this->number} - {$this->zipcode} - {$this->city} - {$this->state}";
    }
}