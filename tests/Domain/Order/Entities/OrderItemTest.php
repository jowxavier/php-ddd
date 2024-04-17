<?php


use App\DomainDrivenDesign\Domain\Order\Entities\OrderItem;

$orderItem = new OrderItem(1, 'item', 10);

it('should returns object', fn() => expect($orderItem)->toBeObject());