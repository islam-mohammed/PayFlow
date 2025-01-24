# PayFlow

PayFlow is a Laravel-based payment application designed with SOLID principles. It provides a scalable, maintainable, and extendable architecture for integrating multiple payment gateways like Stripe and PayPal. This implementation is part of my work on a card application for a previous company.

---

## Features

- **Multi-Gateway Support**: Easily integrate and switch between different payment gateways (e.g., Stripe, PayPal).
- **SOLID Design**: Follows Single Responsibility, Open/Closed, Liskov Substitution, Interface Segregation, and Dependency Inversion principles.
- **Extensible Architecture**: Add new payment gateways without modifying existing code.
- **Centralized Repository**: Handles all payment-related data storage and retrieval.
- **Validation**: Includes robust request validation for secure transactions.

---

## Getting Started

### Prerequisites

Before you begin, ensure you have the following installed:

- PHP 8.x
- Laravel 10.x
- Composer

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/payflow.git
   ```

2. Navigate to the project directory:
   ```bash
   cd payflow
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Set up your `.env` file:
   ```bash
   cp .env.example .env
   ```

5. Run database migrations:
   ```bash
   php artisan migrate
   ```

6. Run the application:
   ```bash
   php artisan serve
   ```

---

## Usage

### Creating a Payment

To create a payment, send a `POST` request to the `/payments` endpoint with the required parameters.

#### Example Request:
```bash
POST /payments
Content-Type: application/json

{
    "gateway": "stripe",
    "amount": 100.00,
    "data": {
        "card_number": "4242424242424242",
        "expiry_date": "12/25",
        "cvv": "123"
    }
}
```

#### Example Response:
```json
{
    "transaction_id": "stripe_12345",
    "status": "success",
    "amount": 100.00
}
```

### Refunding a Payment

To process a refund, use the `RefundPaymentAction` service within your application.

#### Example Usage:
```php
$response = $refundPaymentAction->execute('stripe', 'stripe_12345', 50.00);
return response()->json($response);
```

#### Example Response:
```json
{
    "status": "success",
    "message": "Refund processed successfully."
}
```

---

## Unit Testing

This project includes comprehensive unit tests for all major components, ensuring the reliability and accuracy of the codebase. The tests cover:

- **PaymentGatewayInterface implementations**: Stripe and PayPal gateways.
- **GatewayFactory**: Dynamic creation of payment gateways.
- **PaymentRepository**: Data persistence and retrieval.
- **Actions**: Business logic for payment creation and refunds.
- **PaymentController**: End-to-end request handling.

### Running Tests

1. Set up the test environment in your `.env.testing` file:
   ```dotenv
   DB_CONNECTION=sqlite
   DB_DATABASE=:memory:
   ```

2. Run all tests with the following command:
   ```bash
   php artisan test
   ```

#### Example Output:
```
PHPUnit 9.5.10 by Sebastian Bergmann and contributors.

..........                                                    10 / 10 (100%)

Time: 00:02.345, Memory: 12.00 MB

OK (10 tests, 24 assertions)
```

---

## About

This implementation is part of my work for **GovAssist** company, focusing on a card application that integrates modern payment solutions with a scalable and maintainable architecture.


