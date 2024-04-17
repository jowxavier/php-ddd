<?php

namespace App\DomainDrivenDesign\Domain\Product\Services;

use App\DomainDrivenDesign\Domain\Product\Entities\Product;

class ProductService 
{
    public static function incrisePrice(Product|array $products, float $percentage): array 
    {
        return array_map(function($product) use($percentage) {         
            return $product->changePrice(($product->getPrice() * $percentage) / 100 + $product->getPrice());
        }, $products);
    }

}