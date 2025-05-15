<?php

namespace App\ArchitectLabCodeTest\Interfaces;

interface BasketInterface
{
    /**
     * Add a product by product code.
     *
     * @return void
     */
    public function add(string $productCode): void;

    /**
     * Return basket total.
     *
     * @return float
     */
    public function total(): float;

    /**
     * Returns an array of basket items with product codes as keys and quantities as values.
     *
     * @return array<string, int>
     */
    public function items(): array;
}
