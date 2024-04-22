<?php

use App\DomainDrivenDesign\Domain\Customer\Exceptions\CustomerNotFoundException;

$id = 100;
it('should returns id not found', function () use ($id) {
    throw new CustomerNotFoundException($id);
})->throws(CustomerNotFoundException::class, "Id {$id} not found");