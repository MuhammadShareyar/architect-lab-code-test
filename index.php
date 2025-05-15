<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\ArchitectLabCodeTest\Basket;
use App\ArchitectLabCodeTest\DeliveryService;
use App\ArchitectLabCodeTest\OffersService;

$catelogueItems = ['R01' => 32.95, 'B01' => 7.95, 'G01' => 24.95];

$basket = new Basket(
    $catelogueItems,
    [new DeliveryService()],
    [new OffersService('R01', 2)]
);

$basket->add('R01');
$basket->add('R01');
$basket->add('B01');

echo "<pre>";
echo "Catelogue" . PHP_EOL;
print_r($catelogueItems);
echo "Total: " . $basket->total() . PHP_EOL;
print_r($basket->items());
