<?php

namespace App\ArchitectLabCodeTest\Interfaces;

interface DiscountOfferInterface
{
    /**
     * Apply the discount to the subtotal.
     *
     * @param array<string, int> $basket    
     * @param array<string, float> $catalogue Product items codes as keys and prices as values.
     * @param float $subtotal Current subtotal.
     * @return float Updated subtotal after applying the discount.
     */
    public function apply(array $basket, array $catalogue, float $subtotal): float;
}
