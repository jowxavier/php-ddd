<?php

use App\DomainDrivenDesign\Domain\Product\Entities\Product;

$product = new Product(1, 'item', 10);
it('should returns object', fn() => expect($product)->toBeObject());

it('should throw name validation exception', function () {
    new Product(1, '', 10);
})->throws(DomainException::class, 'Name is not valid.');

it('should throw price validation exception', function () {
    new Product(1, 'item', 0);
})->throws(DomainException::class, 'Price is not valid.');
