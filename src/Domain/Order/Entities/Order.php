<?php

namespace App\DomainDrivenDesign\Domain\Order\Entities;

use DomainException;
use App\DomainDrivenDesign\Domain\Order\Entities\OrderItem;

class Order
{
    public function __construct(
        private string $id, 
        private string $customerId, 
        private OrderItem|array $orderItem = [],
    )
    {
        $this->validate();
    }

    public function getId() 
    {
        return $this->id;
    }

    public function getCustomerId() 
    {
        return $this->customerId;
    }

    public function getOrderItem() 
    {
        return $this->orderItem;
    }

    private function validate() 
    {
        if (empty($this->customerId)) {
            throw new DomainException('Customer is not valid.');
        }
    }

    public function total()
    {
        return array_reduce($this->orderItem, function($total, $item) {
            $total += $item->total();
            return $total;
        }); 
    }
}

