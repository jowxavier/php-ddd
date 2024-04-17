<?php

use App\DomainDrivenDesign\Domain\Product\Entities\Product;
use App\DomainDrivenDesign\Domain\Product\Services\ProductService;

describe("Product Service unit tests", function() {
    it("Should change the price of all products", function() {
        $product1 = new Product(1, 'product 1', 10);
        $product2 = new Product(2, 'product 2', 20);
        $products = [$product1, $product2];

        ProductService::incrisePrice($products, 100);

        expect($product1->getPrice())->toBe(20.0);
        expect($product2->getPrice())->toBe(40.0);
    });
});