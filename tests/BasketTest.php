<?php

namespace Tests;

use App\ArchitectLabCodeTest\Basket;
use App\ArchitectLabCodeTest\DeliveryService;
use App\ArchitectLabCodeTest\OffersService;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    public function testThrowsExceptionForInvalidProductCode(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No product with code X01 found!');

        $catelogue = ['R01' => 32.95, 'B01' => 7.95];
        $basket = new Basket($catelogue);

        $basket->add('X01'); // Invalid product code
    }
    
    public function testAddItemToBasket(): void
    {
        $catelogue = ['R01' => 32.95, 'B01' => 7.95];
        $basket = new Basket($catelogue);

        $basket->add('R01');
        $basket->add('B01');

        $this->assertEquals(['R01' => 1, 'B01' => 1], $basket->items());
    }

    public function testAddMultipleItemsToBasket(): void
    {
        $catelogue = ['R01' => 32.95, 'B01' => 7.95];
        $basket = new Basket($catelogue);

        $basket->add('R01');
        $basket->add('R01');
        $basket->add('B01');

        $this->assertEquals(['R01' => 2, 'B01' => 1], $basket->items());
    }

    public function testCalculateTotalWithoutOffersOrDelivery(): void
    {
        $catelogue = ['R01' => 32.95, 'B01' => 7.95];
        $basket = new Basket($catelogue);

        $basket->add('R01');
        $basket->add('B01');

        $this->assertEquals(40.90, $basket->total());
    }

    public function testCalculateTotalWithOffers(): void
    {
        $catelogue = ['R01' => 32.95, 'B01' => 7.95];
        $offers = [new OffersService('R01', 2)];
        $basket = new Basket($catelogue, [], $offers);

        $basket->add('R01');
        $basket->add('R01');

        // The offer give 50% discount on the second 'R01'
        $this->assertEquals(49.43, $basket->total());
    }

    public function testCalculateTotalWithDeliveryRules(): void
    {
        $catelogue = ['R01' => 32.95, 'B01' => 7.95];
        $deliveryRules = [new DeliveryService()];

        $basket = new Basket($catelogue, $deliveryRules);

        $basket->add('R01');
        $basket->add('B01');

        // Total is 40.90 + 4.95 delivery fee
        $this->assertEquals(45.85, $basket->total());
    }

    public function testBasketWithOffersAndDelivery(): void
    {
        $catelogue = ['R01' => 32.95,'B01' => 7.95, 'G01' => 24.95,
        ];

        $offers = [
            new OffersService('R01', 3), // 50% discount on the second "R01"
        ];

        $deliveryRules = [
            new class {
                public function apply(float $subtotal): float
                {
                    // Free delivry for order >= 90
                    return $subtotal >= 90 ? 0 : 4.95;
                }
            },
        ];

        $basket = new Basket($catelogue, $deliveryRules, $offers);

        // Add items to the basket
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('B01');

        // Total before delivery: 90.33
        // Delivery fee: 0 (free delivery for orders >= 90)
        // Final total: 90.33 (rounded to 2 decimal places)

        $this->assertEquals(90.33, $basket->total());
        $this->assertEquals(['R01' => 3, 'B01' => 1], $basket->items());
    }

    
}