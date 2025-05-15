<?php

namespace App\ArchitectLabCodeTest;

use App\ArchitectLabCodeTest\Interfaces\DeliveryRuleInterface;

class DeliveryService implements DeliveryRuleInterface

{
    public function apply(float $subtotal): float
    {
        if ($subtotal >= 90) {
            return 0.00;
        } elseif ($subtotal >= 50) {
            return 2.95;
        } else {
            return 4.95;
        }
    }
}
