# Laravel Twilio

A clean, Laravel-idiomatic Twilio integration package focused on SMS messaging, designed with proper separation of concerns and future extensibility.

This package provides:
- A Facade-based public API
- A Service layer for use-cases
- A dedicated HTTP client for Twilio
- Request-specific Resource objects
- Full Laravel package auto-discovery

## Features
- Send SMS using Twilio API
- Clean Facade API (Twilio::sendMessage())
- Proper Service → Client → Request architecture
- Laravel 9 / 10 / 11 / 12 compatible
- Config-driven credentials
- Testable design (HTTP layer isolated)

## Installation
Since this package is not yet published on Packagist, add the repository
manually to your project's `composer.json`:<br>
NOTE: **This step is only required until the package is published on Packagist.**
```json
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/sonichandni/laravel-twilio"
  }
]
```

Then install the package:

```bash
composer require sonichandni/laravel-twilio
```

Configuration
.env
```
TWILIO_ACCOUNT_SID=your_account_sid
TWILIO_AUTH_TOKEN=your_auth_token
TWILIO_FROM=+1234567890
```

## Usage
Send an SMS
```
Twilio::sendMessage(
    '+919999999999',
    'Hello from Laravel Twilio'
);
```
No imports required — the Facade alias is auto-registered.

Check if Twilio is Configured
```
if (Twilio::isEnabled()) {
    Twilio::sendMessage($to, $message);
}
```

## Architecture Overview
This package follows a clean Laravel package architecture:
```
Facade (public API)
   ↓
Service (use-cases)
   ↓
HTTP Client (Twilio transport)
   ↓
Request Resource (endpoint + payload)
```

Why this matters
- Easy to extend (WhatsApp, Verify)
- Easy to test (HTTP isolated)
- No framework leakage into core logic
- Clear responsibilities

## Testing
Package tests are provided and designed to be HTTP-fake friendly.
Run tests:
```
vendor/bin/phpunit
```

## Roadmap
- WhatsApp messaging
- Twilio Verify (OTP)
- Message status lookup
- Retry & failure handling
- Laravel Notification channel

## Extending the Package
- To add a new Twilio feature:
- Create a new Request class (e.g. SendWhatsAppMessage)
- Reuse the existing TwilioClient
- Add a method to the Twilio Service
- Expose via the Facade
The public API remains stable.

## License <br>
MIT © Chandni Soni