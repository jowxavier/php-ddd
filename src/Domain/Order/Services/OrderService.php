<?php

namespace App\DomainDrivenDesign\Domain\Order\Services;

use App\DomainDrivenDesign\Domain\Order\Entities\Order;

class OrderService 
{
    public static function total(Order|array $orders): float 
    {
        return array_reduce($orders, function($price, $order) {
            $price += $order->total();
            return $price;
        });
    }
}