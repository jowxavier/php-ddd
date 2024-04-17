<?php


use App\DomainDrivenDesign\Domain\Order\Entities\OrderItem;
use App\DomainDrivenDesign\Domain\Product\Entities\Product;

$product = new Product(1, 'product', 10);
$orderItem = new OrderItem(1, $product->getId(), 'item', 10, 1);

it('should returns object', fn() => expect($orderItem)->toBeObject());