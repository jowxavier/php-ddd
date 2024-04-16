<?php

use App\DomainDrivenDesign\Domain\Customer\Entities\Customer;

$customer = (new Customer())
                ->setName('Jonathan Xavier Ribeiro')
                ->setEmail('jonathanxribeiro@gmail.com');

it('should returns object', fn() => expect($customer)->toBeObject());

