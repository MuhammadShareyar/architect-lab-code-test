<?php

namespace App\ArchitectLabCodeTest\Interfaces;

interface DeliveryRuleInterface
{
    public function apply(float $total): float;
}
