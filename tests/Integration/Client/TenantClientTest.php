<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Integration\Client;

use DateTimeImmutable;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use SandwaveIo\Acronis\AcronisClient;
use SandwaveIo\Acronis\Client\RestClient;
use SandwaveIo\Acronis\Entity\ApplicationUuidCollection;
use SandwaveIo\Acronis\Entity\Contact;
use SandwaveIo\Acronis\Entity\InfraUuidCollection;
use SandwaveIo\Acronis\Entity\OfferingCollection;
use SandwaveIo\Acronis\Entity\Tenant;
use SandwaveIo\Acronis\Entity\TenantCollection;
use SandwaveIo\Acronis\Entity\TenantEdition;
use SandwaveIo\Acronis\Entity\Usage;
use SandwaveIo\Acronis\Entity\UsageCollection;
use SandwaveIo\Acronis\Entity\UserUuidCollection;

class TenantClientTest extends TestCase
{
    public function testGet(): void
    {
        $jsonResponse = '{"id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","version":2,"name":"The Qwerty Tenant","customer_type":"enterprise","parent_id":"fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f","kind":"partner","contact":{"id":"27f6f164-63dd-47df-b5b6-83a0fd117beb","created_at":"2020-05-19T11:50:00","updated_at":"2020-05-19T11:50:01","types":["legal"],"email":"me@mysite.com","address1":"1440 River Drive #100","address2":"","country":"USA","state":"CA","zipcode":"12345","city":"Rivertown","phone":"123456789","firstname":"John","lastname":"Doe","title":"","website":"","industry":"","organization_size":"","email_confirmed":false,"aan":"111111"},"contacts":[],"enabled":true,"created_at":"2016-06-22T18:25:16","updated_at":"2016-06-22T18:25:17","deleted_at":null,"customer_id":"123asd","brand_id":1,"brand_uuid":"03fa8bf4-28f2-11e7-ba28-cbe99c3c450a","internal_tag":null,"language":"en","owner_id":"03fa8bf4-28f2-11e7-ba28-cbe99c3c450a","has_children":true,"ancestral_access":true,"update_lock":{"enabled":true,"owner_id":"7decff12-ee1b-4f8d-b446-59610bfb9203"},"mfa_status":"enabled","pricing_mode":"production"}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $restClient = new RestClient($guzzle, $serializerBuilder->build());

        $acronisClient = new AcronisClient($restClient);
        $tenant = $acronisClient->getTenantClient()->get('f313ecf6-9256-4afd-9d47-72e032ee81d0');

        self::assertInstanceOf(Tenant::class, $tenant);
        self::assertInstanceOf(DateTimeImmutable::class, $tenant->getCreatedAt());
        self::assertInstanceOf(DateTimeImmutable::class, $tenant->getUpdatedAt());
        self::assertSame('f313ecf6-9256-4afd-9d47-72e032ee81d0', $tenant->getId());
        self::assertSame('fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f', $tenant->getParentId());
        self::assertSame('03fa8bf4-28f2-11e7-ba28-cbe99c3c450a', $tenant->getBrandUuid());
        self::assertSame(1, $tenant->getBrandId());
        self::assertSame('123asd', $tenant->getCustomerId());
        self::assertSame(2, $tenant->getVersion());
        self::assertSame('The Qwerty Tenant', $tenant->getName());
        self::assertSame('enterprise', $tenant->getCustomerType());
        self::assertSame('enabled', $tenant->getMfaStatus());
        self::assertSame('partner', $tenant->getKind());
        self::assertSame('production', $tenant->getPricingMode());
        self::assertSame('en', $tenant->getLanguage());
        self::assertTrue($tenant->isEnabled());
        self::assertTrue($tenant->hasChildren());
        self::assertTrue($tenant->isAncestralAccess());
        self::assertSame('2016-06-22 18:25:16', $tenant->getCreatedAt()->format('Y-m-d H:i:s'));
        self::assertSame('2016-06-22 18:25:17', $tenant->getUpdatedAt()->format('Y-m-d H:i:s'));
        self::assertNull($tenant->getDeletedAt());

        self::assertInstanceOf(Contact::class, $tenant->getContact());
        self::assertInstanceOf(DateTimeImmutable::class, $tenant->getContact()->getCreatedAt());
        self::assertInstanceOf(DateTimeImmutable::class, $tenant->getContact()->getUpdatedAt());
        self::assertSame('27f6f164-63dd-47df-b5b6-83a0fd117beb', $tenant->getContact()->getId());
        self::assertSame('John', $tenant->getContact()->getFirstname());
        self::assertSame('Doe', $tenant->getContact()->getLastname());
        self::assertSame('me@mysite.com', $tenant->getContact()->getEmail());
        self::assertSame('1440 River Drive #100', $tenant->getContact()->getAddress1());
        self::assertSame('', $tenant->getContact()->getAddress2());
        self::assertSame('USA', $tenant->getContact()->getCountry());
        self::assertSame('CA', $tenant->getContact()->getState());
        self::assertSame('12345', $tenant->getContact()->getZipcode());
        self::assertSame('Rivertown', $tenant->getContact()->getCity());
        self::assertSame('123456789', $tenant->getContact()->getPhone());
        self::assertSame('2020-05-19 11:50:00', $tenant->getContact()->getCreatedAt()->format('Y-m-d H:i:s'));
        self::assertSame('2020-05-19 11:50:01', $tenant->getContact()->getUpdatedAt()->format('Y-m-d H:i:s'));
    }

    public function testGetChildren(): void
    {
        $jsonResponse = '{"timestamp":"2016-06-22T18:25:16","items":[{"id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","version":2,"name":"The Qwerty Tenant","customer_type":"enterprise","parent_id":"fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f","kind":"partner","contact":{"id":"27f6f164-63dd-47df-b5b6-83a0fd117beb","created_at":"2020-05-19T11:50:00","updated_at":"2020-05-19T11:50:00","types":["legal"],"email":"me@mysite.com","address1":"1440 River Drive #100","address2":"","country":"USA","state":"CA","city":"Rivertown","zipcode":"12345","phone":"123456789","firstname":"John","lastname":"Doe","title":"","website":"","industry":"","organization_size":"","email_confirmed":false,"aan":"","language":"en","fax":"123 Example Street"},"contacts":[],"enabled":true,"created_at":"2016-06-22T18:25:16","updated_at":"2016-06-22T18:25:16","deleted_at":null,"customer_id":"123asd","brand_id":1,"brand_uuid":"03fa8bf4-28f2-11e7-ba28-cbe99c3c450a","internal_tag":null,"language":"en","owner_id":"03fa8bf4-28f2-11e7-ba28-cbe99c3c450a","has_children":true,"ancestral_access":true,"update_lock":{"enabled":false,"owner_id":null},"mfa_status":"enabled","pricing_mode":"trial"},{"id":"5d92a310-0ee7-11e7-95e6-5f64824358de","version":2,"name":"The Another Tenant","customer_type":"enterprise","parent_id":"fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f","kind":"partner","contact":{"id":"27f6f164-63dd-47df-b5b6-83a0fd117bec","created_at":"2020-05-19T11:50:00","updated_at":"2020-05-19T11:50:00","types":["legal","technical"],"email":"me@mysite.com","address1":"1440 River Drive #100","address2":"","country":"USA","state":"CA","city":"Rivertown","zipcode":"12345","phone":"123456789","firstname":"John","lastname":"Doe","title":"","website":"","industry":"","organization_size":"","email_confirmed":false,"aan":"","language":"en","fax":"123 Example Street"},"contacts":[],"enabled":true,"created_at":"2016-06-22T18:25:16","updated_at":"2016-06-22T18:25:16","deleted_at":null,"customer_id":"123asd","brand_id":1,"brand_uuid":"03fa8bf4-28f2-11e7-ba28-cbe99c3c450a","internal_tag":null,"language":"en","owner_id":"03fa8bf4-28f2-11e7-ba28-cbe99c3c450a","has_children":true,"ancestral_access":true,"update_lock":{"enabled":false,"owner_id":null},"mfa_status":"disabled","pricing_mode":"production"}]}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $tenantCollection = $acronisClient->getTenantClient()->getChildren('fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f');
        $firstTenant = $tenantCollection->getItems()[0];

        self::assertInstanceOf(TenantCollection::class, $tenantCollection);
        self::assertInstanceOf(DateTimeImmutable::class, $tenantCollection->getTimestamp());
        self::assertInstanceOf(Tenant::class, $firstTenant);
    }

    public function testCreate(): void
    {
        $contact = new Contact(
            ['legal'],
            'me@mysite.com',
            'John',
            'Doe'
        );
        $contact->setAcronisAccountNumber('111111')
            ->setAddress1('1440 River Drive #100')
            ->setAddress2('')
            ->setCountry('USA')
            ->setState('CA')
            ->setZipcode('12345')
            ->setCity('Rivertown')
            ->setPhone('123456789');
        $tenant = new Tenant(
            'fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f',
            'The Qwerty Tenant',
            'partner'
        );
        $tenant->setOwnerId('03fa8bf4-28f2-11e7-ba28-cbe99c3c450a')
            ->setBrandUuid('03fa8bf4-28f2-11e7-ba28-cbe99c3c450a')
            ->setBrandId(1)
            ->setCustomerId('123asd')
            ->setVersion(2)
            ->setInternalTag('internal-tag')
            ->setCustomerType('enterprise')
            ->setMfaStatus('enabled')
            ->setPricingMode('production')
            ->setLanguage('en')
            ->setEnabled(true)
            ->setHasChildren(true)
            ->setAncestralAccess(true)
            ->setContact($contact);
        $jsonResponse = '{"id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","version":2,"name":"The Qwerty Tenant","customer_type":"enterprise","parent_id":"fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f","kind":"partner","contact":{"id":"27f6f164-63dd-47df-b5b6-83a0fd117beb","created_at":"2020-05-19T11:50:00","updated_at":"2020-05-19T11:50:00","types":["legal"],"email":"me@mysite.com","address1":"1440 River Drive #100","address2":"","country":"USA","state":"CA","zipcode":"12345","city":"Rivertown","phone":"123456789","firstname":"John","lastname":"Doe","title":"","website":"","industry":"","organization_size":"","email_confirmed":false,"aan":"111111"},"contacts":[],"enabled":true,"created_at":"2016-06-22T18:25:16","updated_at":"2016-06-22T18:25:16","deleted_at":null,"customer_id":"123asd","brand_id":1,"brand_uuid":"03fa8bf4-28f2-11e7-ba28-cbe99c3c450a","internal_tag":"internal-tag","language":"en","owner_id":"03fa8bf4-28f2-11e7-ba28-cbe99c3c450a","has_children":true,"ancestral_access":true,"update_lock":{"enabled":true,"owner_id":"7decff12-ee1b-4f8d-b446-59610bfb9203"},"mfa_status":"enabled","pricing_mode":"production"}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $stack->push(function (callable $handler) use ($tenant) {
            return function (RequestInterface $request, $options) use ($handler, $tenant) {
                $body = $request->getBody()->getContents();
                self::assertJson($body);

                $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                self::assertArrayNotHasKey('id', $decoded);
                self::assertArrayNotHasKey('customer_type', $decoded);
                self::assertArrayNotHasKey('ancestral_access', $decoded);
                self::assertArrayNotHasKey('created_at', $decoded);
                self::assertArrayNotHasKey('updated_at', $decoded);
                self::assertArrayNotHasKey('deleted_at', $decoded);
                self::assertSame($tenant->getParentId(), $decoded['parent_id']);
                self::assertSame($tenant->getOwnerId(), $decoded['owner_id']);
                self::assertSame($tenant->getBrandUuid(), $decoded['brand_uuid']);
                self::assertSame($tenant->getBrandId(), $decoded['brand_id']);
                self::assertSame($tenant->getCustomerId(), $decoded['customer_id']);
                self::assertSame($tenant->getVersion(), $decoded['version']);
                self::assertSame($tenant->getName(), $decoded['name']);
                self::assertSame($tenant->getInternalTag(), $decoded['internal_tag']);
                self::assertSame($tenant->getMfaStatus(), $decoded['mfa_status']);
                self::assertSame($tenant->getKind(), $decoded['kind']);
                self::assertSame($tenant->getPricingMode(), $decoded['pricing_mode']);
                self::assertSame($tenant->getLanguage(), $decoded['language']);
                self::assertTrue($decoded['enabled']);
                self::assertTrue($decoded['has_children']);

                /** @var Contact $contact */
                $contact = $tenant->getContact();
                self::assertArrayNotHasKey('id', $decoded['contact']);
                self::assertArrayNotHasKey('created_at', $decoded['contact']);
                self::assertArrayNotHasKey('updated_at', $decoded['contact']);
                self::assertSame($contact->getAcronisAccountNumber(), $decoded['contact']['aan']);
                self::assertSame($contact->getTypes(), $decoded['contact']['types']);
                self::assertSame($contact->getFirstname(), $decoded['contact']['firstname']);
                self::assertSame($contact->getLastname(), $decoded['contact']['lastname']);
                self::assertSame($contact->getEmail(), $decoded['contact']['email']);
                self::assertSame($contact->getAddress1(), $decoded['contact']['address1']);
                self::assertSame($contact->getAddress2(), $decoded['contact']['address2']);
                self::assertSame($contact->getCountry(), $decoded['contact']['country']);
                self::assertSame($contact->getState(), $decoded['contact']['state']);
                self::assertSame($contact->getZipcode(), $decoded['contact']['zipcode']);
                self::assertSame($contact->getCity(), $decoded['contact']['city']);
                self::assertSame($contact->getPhone(), $decoded['contact']['phone']);

                return $handler($request, $options);
            };
        });

        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $acronisClient->getTenantClient()->create($tenant);
    }

    public function testUpdate(): void
    {
        $contact = new Contact(
            ['legal'],
            'me@mysite.com',
            'John',
            'Doe'
        );
        $contact->setId('27f6f164-63dd-47df-b5b6-83a0fd117beb');
        $tenant = new Tenant(
            'fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f',
            'The Qwerty Tenant',
            'partner'
        );
        $tenant->setId('f313ecf6-9256-4afd-9d47-72e032ee81d0')
            ->setContact($contact);
        $jsonResponse = '{"id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","version":2,"name":"The Qwerty Tenant","customer_type":"enterprise","parent_id":"fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f","kind":"partner","contact":{"id":"27f6f164-63dd-47df-b5b6-83a0fd117beb","created_at":"2020-05-19T11:50:00","updated_at":"2020-05-19T11:50:00","types":["legal"],"email":"me@mysite.com","address1":"1440 River Drive #100","address2":"","country":"USA","state":"CA","zipcode":"12345","city":"Rivertown","phone":"123456789","firstname":"John","lastname":"Doe","title":"","website":"","industry":"","organization_size":"","email_confirmed":false,"aan":"111111"},"contacts":[],"enabled":true,"created_at":"2016-06-22T18:25:16","updated_at":"2016-06-22T18:25:16","deleted_at":null,"customer_id":"123asd","brand_id":1,"brand_uuid":"03fa8bf4-28f2-11e7-ba28-cbe99c3c450a","internal_tag":"internal-tag","language":"en","owner_id":"03fa8bf4-28f2-11e7-ba28-cbe99c3c450a","has_children":true,"ancestral_access":true,"update_lock":{"enabled":true,"owner_id":"7decff12-ee1b-4f8d-b446-59610bfb9203"},"mfa_status":"enabled","pricing_mode":"production"}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $stack->push(function (callable $handler) use ($tenant) {
            return function (RequestInterface $request, $options) use ($handler, $tenant) {
                $body = $request->getBody()->getContents();
                self::assertJson($body);

                $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                self::assertArrayHasKey('id', $decoded);
                self::assertArrayNotHasKey('customer_type', $decoded);
                self::assertArrayNotHasKey('ancestral_access', $decoded);
                self::assertArrayNotHasKey('created_at', $decoded);
                self::assertArrayNotHasKey('updated_at', $decoded);
                self::assertArrayNotHasKey('deleted_at', $decoded);
                self::assertSame($tenant->getId(), $decoded['id']);

                /** @var Contact $contact */
                $contact = $tenant->getContact();
                self::assertArrayHasKey('id', $decoded['contact']);
                self::assertArrayNotHasKey('created_at', $decoded['contact']);
                self::assertArrayNotHasKey('updated_at', $decoded['contact']);
                self::assertSame($contact->getId(), $decoded['contact']['id']);

                return $handler($request, $options);
            };
        });

        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $acronisClient->getTenantClient()->update($tenant);
    }

    public function testGetUsersByTenantUuid(): void
    {
        $jsonResponse = '{"items":["aa4f8923-8950-4804-8827-c6d78388e5b6","4eb7b320-48b4-4552-9bf8-f7482538da23"]}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $userUuidCollection = $acronisClient->getTenantClient()->getUsersByTenantUuid('fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f');
        $firstUserUuid = $userUuidCollection->getItems()[0];

        self::assertInstanceOf(UserUuidCollection::class, $userUuidCollection);
        self::assertSame('aa4f8923-8950-4804-8827-c6d78388e5b6', $firstUserUuid);
    }

    public function testDelete(): void
    {
        $response = 'Tenant successfully deleted';
        $tenant = new Tenant(
            'fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f',
            'The Qwerty Tenant',
            'partner'
        );
        $tenant->setId('f313ecf6-9256-4afd-9d47-72e032ee81d0')
            ->setVersion(2);

        $mockHandler = new MockHandler(
            [new Response(204, [], $response)]
        );
        $stack = HandlerStack::create($mockHandler);
        $stack->push(function (callable $handler) {
            return function (RequestInterface $request, $options) use ($handler) {
                self::assertSame('DELETE', $request->getMethod());

                return $handler($request, $options);
            };
        });
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $acronisClient->getTenantClient()->delete($tenant);
    }

    public function testGetApplications(): void
    {
        $jsonResponse = '{"items":["aa4f8923-8950-4804-8827-c6d78388e5b6","4eb7b320-48b4-4552-9bf8-f7482538da23"]}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $applicationUuidCollection = $acronisClient->getTenantClient()->getAvailableApplications('fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f');
        $firstUserUuid = $applicationUuidCollection->getItems()[0];

        self::assertInstanceOf(ApplicationUuidCollection::class, $applicationUuidCollection);
        self::assertSame('aa4f8923-8950-4804-8827-c6d78388e5b6', $firstUserUuid);
    }

    public function testGetInfra(): void
    {
        $jsonResponse = '{"infras":["d9fd4cc3-4309-40a2-bd79-88da24a1c99d","7068976a-22c0-476e-ae3b-5f0469981ff1"]}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $infraUuidCollection = $acronisClient->getTenantClient()->getInfra('fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f');
        $firstUserUuid = $infraUuidCollection->getItems()[0];

        self::assertInstanceOf(InfraUuidCollection::class, $infraUuidCollection);
        self::assertSame('d9fd4cc3-4309-40a2-bd79-88da24a1c99d', $firstUserUuid);
    }

    public function testGetUsage(): void
    {
        $jsonResponse = '{"items":[{"application_id":"c6ab7fb4-b461-4214-9257-86fbad8efb85","name":"adv_vms","edition":"advanced","usage_name":"vms","type":"count","measurement_unit":"quantity","range_start":"2017-06-01T00:00:00","absolute_value":800,"value":800,"offering_item":{"status":1,"quota":{"value":10,"overage":10,"version":1486479690324}}},{"application_id":"c6ab7fb4-b461-4214-9257-86fbad8efb85","name":"storage","edition":"standard","usage_name":"storage","type":"infra","measurement_unit":"bytes","infra_id":"df476eec-c470-40b0-9b10-37223b7f4a2b","range_start":"2017-06-22T00:00:00","absolute_value":800,"value":800,"offering_item":{"status":1,"quota":{"value":1000,"overage":2000,"version":1486479690324}}},{"application_id":"c6ab7fb4-b461-4214-9257-86fbad8efb85","name":"vm_storage","edition":"standard","usage_name":"vm_storage","range_start":"2017-06-01T00:00:00","type":"infra","measurement_unit":"bytes","absolute_value":100000,"value":100000}]}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $usageCollection = $acronisClient->getTenantClient()->getUsage('fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f');
        $firstUsage = $usageCollection->getItems()[0];

        self::assertInstanceOf(UsageCollection::class, $usageCollection);
        self::assertInstanceOf(Usage::class, $firstUsage);
        self::assertInstanceOf(DateTimeImmutable::class, $firstUsage->getRangeStart());
        self::assertSame('count', $firstUsage->getType());
        self::assertSame('adv_vms', $firstUsage->getName());
        self::assertSame('advanced', $firstUsage->getEdition());
        self::assertSame('vms', $firstUsage->getUsageName());
        self::assertSame('2017-06-01 00:00:00', $firstUsage->getRangeStart()->format('Y-m-d H:i:s'));
        self::assertSame(800, $firstUsage->getAbsoluteValue());
        self::assertSame(800, $firstUsage->getValue());
        self::assertSame('quantity', $firstUsage->getMeasurementUnit());
    }

    public function testSwitchEdition(): void
    {
        $jsonResponse = '{"timestamp":"2016-06-22T18:25:16","items":[{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"vms","edition":"standard","usage_name":"vms","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":true,"type":"count","measurement_unit":"quantity","quota":{"value":10,"overage":10,"version":1486479690324}},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"dre_mobiles","edition":"disaster_recovery","usage_name":"mobiles","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":false,"type":"count","measurement_unit":"quantity","quota":{"value":10,"overage":10,"version":1486479690324}},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"local_storage","edition":null,"usage_name":"local_storage","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"type":"feature","measurement_unit":"n/a"},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"adv_storage","edition":"advanced","usage_name":"storage","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":true,"type":"infra","measurement_unit":"bytes","infra_id":"ee978065-8caa-463d-82d7-47006376e7f2","quota":{"value":1000,"overage":null,"version":1486479690324}}]}';
        $tenantEdition = new TenantEdition(
            'disaster_recovery',
            'c6ab7fb4-b461-4214-9257-86fbad8efb85'
        );

        $mockHandler = new MockHandler(
            [new Response(204, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $stack->push(function (callable $handler) use ($tenantEdition) {
            return function (RequestInterface $request, $options) use ($handler, $tenantEdition) {
                $body = $request->getBody()->getContents();
                self::assertJson($body);

                $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                self::assertSame($tenantEdition->getEdition(), $decoded['target_edition']);
                self::assertSame($tenantEdition->getApplicationId(), $decoded['application_id']);

                return $handler($request, $options);
            };
        });
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $offeringCollection = $acronisClient->getTenantClient()->switchEdition('f313ecf6-9256-4afd-9d47-72e032ee81d0', $tenantEdition);
        self::assertInstanceOf(OfferingCollection::class, $offeringCollection);
    }
}
