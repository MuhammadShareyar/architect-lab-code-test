<?php

namespace App\ArchitectLabCodeTest;

use App\ArchitectLabCodeTest\Interfaces\DiscountOfferInterface;

class OffersService implements DiscountOfferInterface
{
    public function __construct(protected string $productCode, protected int $discountQty) {}

    
    public function apply(array $basket, array $catalogue, float $subtotal): float
    {
        if (!isset($basket[$this->productCode])) {
            return $subtotal;
        }

        $quantity = $basket[$this->productCode];

        if ($quantity < $this->discountQty) {
            return $subtotal;
        }

        $price = $catalogue[$this->productCode];

        $discount = $price * 0.5;

        return $subtotal - $discount;
    }
}
