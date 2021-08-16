discord-interactions-php
---

Types and helper functions that may come in handy when you implement a Discord Interactions webhook.

# Installation

Install from [packagist](https://packagist.org/packages/discord/interactions):

```
composer require discord/interactions
```

Validating request signatures requires the [`simplito/elliptic-php`](https://github.com/simplito/elliptic-php) package to be installed, which requires the `php-gmp` extension to be enabled:

```
composer require simplito/elliptic-php
```

# Usage

Use `InteractionType` and `InteractionResponseType` to interpret and respond to webhooks.

Use `InteractionResponseFlags` to make your response special.

Use `verifyKey` to check a request signature. Note you must install the `simplito/elliptic-php` package first. For example:

```php
use Discord\Interaction;
use Discord\InteractionResponseType;

$CLIENT_PUBLIC_KEY = getenv('CLIENT_PUBLIC_KEY');

$signature = $_SERVER['HTTP_X_SIGNATURE_ED25519'];
$timestamp = $_SERVER['HTTP_X_SIGNATURE_TIMESTAMP'];
$postData = file_get_contents('php://input');

if (Interaction::verifyKey($postData, $signature, $timestamp, $CLIENT_PUBLIC_KEY)) {
  echo json_encode(array(
    'type' => InteractionResponseType::PONG
  ));
} else {
  http_response_code(401);
  echo "Not verified";
}
```
