<?php

use App\DomainDrivenDesign\Domain\Order\Entities\Order;
use App\DomainDrivenDesign\Domain\Order\Entities\OrderItem;
use App\DomainDrivenDesign\Domain\Product\Entities\Product;
use App\DomainDrivenDesign\Domain\Order\Services\OrderService;

describe("Order Service unit tests", function() {
    it("Should get total of all orders", function() {

        $product = new Product(1, 'product', 10);
        $orderItem1 = new OrderItem(1, $product->getId(), 'item 1', 10, 1);
        $orderItem2 = new OrderItem(2, $product->getId(), 'item 2', 20, 2);

        $order1 = (new Order(1, 1, [$orderItem1]));
        $order2 = (new Order(1, 1, [$orderItem2]));
        $orders = [$order1, $order2];    

        $orderService = OrderService::total($orders);

        expect($orderService)->toBe(50.0);
    });
});