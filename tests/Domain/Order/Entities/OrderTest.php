<?php

use App\DomainDrivenDesign\Domain\Order\Entities\Order;
use App\DomainDrivenDesign\Domain\Order\Entities\OrderItem;
use App\DomainDrivenDesign\Domain\Customer\Entities\Customer;
use App\DomainDrivenDesign\Domain\Customer\ValueObjects\Address;

$address = new Address('Rua 1', 10, '07110010', 'São Paulo', 'SP');
$customer = (new Customer(1, 'Jonathan Xavier Ribeiro', $address));
$orderItem1 = new OrderItem(1, 'item 1', 10);
$orderItem2 = new OrderItem(2, 'item 2', 20);
$order = (new Order(1, $customer->getId(), [$orderItem1, $orderItem2]));

it('should returns object', fn() => expect($order)->toBeObject());
it('should returns 2 Order Item objects', fn() => expect(count($order->getOrderItem()))->toBe(2));