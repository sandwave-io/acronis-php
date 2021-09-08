[![](https://user-images.githubusercontent.com/60096509/91668964-54ecd500-eb11-11ea-9c35-e8f0b20b277a.png)](https://sandwave.io)

# Acronis Client (PHP)

## Supported APIs

This SDK currently supports these APIs:

* [Tenant API](https://eu5-cloud.acronis.com/mc/api/2/doc#tenants)

Are you missing functionality? Feel free to create an issue, or hit us up with a pull request.

## How to use (REST API)

```bash
composer require sandwave-io/acronis-php
```

```php
<?php

use JMS\Serializer\SerializerBuilder;
use SandwaveIo\Acronis\AcronisApi;
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

$acronisApi = new AcronisApi($restClient);
$acronisApi->getTenantClient()->get('tenant-guid');
```

## How to contribute

Feel free to create a PR if you have any ideas for improvements. Or create an issue.

* When adding code, make sure to add tests for it (phpunit).
* Make sure the code adheres to our coding standards (use php-cs-fixer to check/fix).
* Also make sure PHPStan does not find any bugs.

```bash
vendor/bin/php-cs-fixer fix

vendor/bin/phpstan analyze

vendor/bin/phpunit --coverage-text
```
