<?php

namespace App\ArchitectLabCodeTest;

use App\ArchitectLabCodeTest\Interfaces\BasketInterface;
use Exception;

class Basket implements BasketInterface
{
    /**
     * @param array<string, float> $catelogue
     * @param array<DeliveryService> $deliveryRules
     * @param array<OffersService> $offers
     * @param array<string, int> $basketItems
     */
    public function __construct(
        protected array $catelogue,
        protected array $deliveryRules = [],
        protected  array $offers = [],
        protected array $basketItems = []
    ) {}

    public function add(string $productCode): void
    {
        if (!isset($this->catelogue[$productCode])) {
            throw new Exception("No product with code $productCode found!");
        }

        if (!isset($this->basketItems[$productCode])) {
            $this->basketItems[$productCode] = 1;
        } else {
            $this->basketItems[$productCode]++;
        }
    }

    public function total(): float
    {
        $subtotal = 0;

        foreach ($this->basketItems as $pcode => $qty) {
            $subtotal += $this->catelogue[$pcode] * $qty;
        }

        // apply offerss
        foreach ($this->offers as $offer) {
            $subtotal = $offer->apply($this->basketItems, $this->catelogue, $subtotal);
        }

        // apply delivery dscount
        foreach ($this->deliveryRules as $rule) {
            $subtotal += $rule->apply($subtotal);
        }

        return round($subtotal, 2);
    }

    public function items(): array
    {
        return $this->basketItems;
    }
}
