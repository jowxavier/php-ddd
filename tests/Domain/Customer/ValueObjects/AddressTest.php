<?php

use App\DomainDrivenDesign\Domain\Customer\ValueObjects\Address;

$address = new Address('Rua 1', 10, '07110010', 'São Paulo', 'SP');

it("shouldn't returns street validate message", fn() => expect($address)->not->toBe('Street is not valid'));
it("shouldn't returns number validate message", fn() => expect($address)->not->toBe('Number is not valid'));
it("shouldn't returns zipcode validate message", fn() => expect($address)->not->toBe('Zip Code is not valid'));
it("shouldn't returns city validate message", fn() => expect($address)->not->toBe('City is not valid'));
it("shouldn't returns state validate message", fn() => expect($address)->not->toBe('State is not valid'));
