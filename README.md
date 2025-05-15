# Product Basket 

It is a PHP-based shopping basket implementation that supports adding items, applying discounts, and calculating totals.

---

## Features
- Add items to the basket.
- Apply discounts.
- Apply delivery rules and offers.
- Fully tested with **PHPUnit**.
- Static analysis with **PHPStan**.
- Containerized with **Docker**.

---

## Requirements
- PHP 8.2 or higher
- Composer
- Docker (optional)

---

## Installation

1. Clone the repository:
   ```sh
   git clone https://github.com/MuhammadShareyar/architect-lab-code-test.git
   cd architect-lab-code-test
   ```

2. Install dependencies:
   ```sh
   composer install
   ```

3. Run static analysis:
   ```sh
   composer phpstan
   ```

4. Run tests:
   ```sh
   composer phpunit
   ```

---

## Run Command

To execute the application, you can either run it directly with PHP or use Docker.

### Using PHP
```sh
php index.php
```

### Using Docker
1. Build the Docker image:
    ```sh
    docker build -t architect-lab-code-test .
    ```

2. Run the container:
    ```sh
    docker run --rm -v $(pwd):/app -w /app architect-lab-code-test php index.php
    ```

---

## Project Structure

```
.
├── src/
│   ├── Basket.php
│   ├── Interfaces/
│   │   ├── BasketInterface.php
│   │   ├── DiscountOfferInterface.php
│   ├── OffersService.php
│   ├── DeliveryService.php
├── tests/
│   ├── BasketTest.php
├── composer.json
├── index.php
├── phpstan.neon
├── Dockerfile
└── README.md
```