<?php

use App\DomainDrivenDesign\Domain\Customer\Entities\Customer;
use App\DomainDrivenDesign\Domain\Customer\ValueObjects\Address;

$customer = new Customer();
$customer->id = 1;
$customer->name = 'Jonathan Xavier Ribeiro';
$customer->address = new Address(1, 'Rua 1', 10, '07110010', 'São Paulo', 'SP');

it('should returns object', fn() => expect($customer)->toBeObject());
it("shouldn't returns changeName validate message", fn() => expect($customer->changeName('Jack Sparrow'))->not->toBe('Name is not valid.'));
it("shouldn't returns activate validate message", fn() => expect($customer->activate())->not->toBe('Address is mandatory to activate customer.'));

