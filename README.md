[![](https://user-images.githubusercontent.com/60096509/91668964-54ecd500-eb11-11ea-9c35-e8f0b20b277a.png)](https://sandwave.io)


# Acronis API - PHP SDK

[![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/sandwave-io/acronis-php/ci.yml?branch=main)](https://packagist.org/packages/sandwave-io/acronis-php)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/sandwave-io/acronis-php)](https://packagist.org/packages/sandwave-io/acronis-php)
[![Packagist PHP Version Support](https://img.shields.io/packagist/v/sandwave-io/acronis-php)](https://packagist.org/packages/sandwave-io/acronis-php)
[![Packagist Downloads](https://img.shields.io/packagist/dt/sandwave-io/acronis-php)](https://packagist.org/packages/sandwave-io/acronis-php)

## Supported APIs

This SDK currently supports these APIs:

* [Offering API](https://eu5-cloud.acronis.com/mc/api/2/doc#offering_items)
* [Search API](https://eu5-cloud.acronis.com/mc/api/2/doc#search)
* [Tenant API](https://eu5-cloud.acronis.com/mc/api/2/doc#tenants)
* [User API](https://eu5-cloud.acronis.com/mc/api/2/doc#users)

Are you missing functionality? Feel free to create an issue, or hit us up with a pull request.

## How to use (REST API)

```bash
composer require sandwave-io/acronis-php
```

```php
<?php

use JMS\Serializer\SerializerBuilder;
use SandwaveIo\Acronis\AcronisClient;
use SandwaveIo\Acronis\Client\RestClient;
use SandwaveIo\Acronis\RestClientFactory;

$factory = new RestClientFactory(
    'api-endpoint',
    'client-identifier',
    'client-secret'
);

$serializerBuilder = new SerializerBuilder();
$restClient = new RestClient(
    $factory->create(),
    $serializerBuilder->build()
);

$acronisClient = new AcronisClient($restClient);
$acronisClient->getTenantClient()->get('tenant-guid');
```

## How to contribute

Feel free to create a PR if you have any ideas for improvements. Or create an issue.

* When adding code, make sure to add tests for it (phpunit).
* Make sure the code adheres to our coding standards (use php-cs-fixer to check/fix).
* Also make sure PHPStan does not find any bugs.

```bash
composer analyze # this will (dry)run php-cs-fixer, phpstan and phpunit

composer phpcs-fix # this will actually let php-cs-fixer run to fix
```

These tools will also run in GitHub actions on PR's and pushes on main.
