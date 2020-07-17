# TYPO3 Datahub API Library

This library can be used to interact with the TYPO3 Datahub. It provides a set of API services, factories and entities for easy use.

## Installation

**NOTE**: This library requires a minimum PHP version of 7.4

```bash
composer require t3g/datahub-api-library
```

## Before you start

This library has been built in a way that it is compliant with [PSR-7](https://www.php-fig.org/psr/psr-7/), [PSR-17](https://www.php-fig.org/psr/psr-17/) and [PSR-18](https://www.php-fig.org/psr/psr-18/). Meaning that the HTTP-Client, the HTTP-Messages and the HTTP request factory objects can be interchanged, as long as they implement the given PSR interfaces.

If you want to use Guzzle, I recommend using the following packages:
```bash
composer require guzzlehttp/guzzle
composer require http-interop/http-factory-guzzle
composer require ricardofiorani/guzzle-psr18-adapter
```

## Usage

To start using the library you can use any of the API classes provided. They have to be built as follows:

**NOTE**: This is the usage if you use the guzzle packages mentioned above. Feel free to use any other PSR compliant library if you wish.
```php
$httpClient = new \RicardoFiorani\GuzzlePsr18Adapter\Client();
$requestFactory = new \Http\Factory\Guzzle\RequestFactory();
$datahubClient = new \T3G\DatahubApiLibrary\Client\DataHubClient($httpClient, $requestFactory, 'YourTokenHere');
$userApi = new \T3G\DatahubApiLibrary\Api\UserApi($datahubClient);

$userApi->getUser('some-username');
```

## Authorization and Tokens

The `T3G\DatahubApiLibrary\Client\DatahubClient` class always needs a token in order to authenticate itself. This token can either be a JWT token (if you are working in the user context) or an OAuth2 access token (if you are working in the app context).

## Testing
```bash
composer test
```
