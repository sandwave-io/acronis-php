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
use SandwaveIo\Acronis\Entity\Contact;
use SandwaveIo\Acronis\Entity\User;
use SandwaveIo\Acronis\Entity\UserCollection;

class UserClientTest extends TestCase
{
    public function testGet(): void
    {
        $jsonResponse = '{"id":"948efcf2-b740-4c40-bb2d-4e4a46adfd87","version":2,"tenant_id":"0ef03214-6e47-4e50-87f2-a5955ba6095c","login":"mylogin","contact":{"id":"27f6f164-63dd-47df-b5b6-83a0fd117beb","created_at":"2020-05-19T11:50:00","updated_at":"2020-05-19T11:50:00","types":[],"email":"me@mysite.com","address1":"1440 River Drive #100","address2":"","country":"USA","state":"CA","zipcode":"12345","city":"Rivertown","phone":"123456789","firstname":"John","lastname":"Doe","title":"","website":"","industry":"","organization_size":"","email_confirmed":false,"aan":"111111"},"activated":true,"enabled":true,"created_at":"2016-06-22T18:25:16","updated_at":"2016-06-22T18:25:16","deleted_at":null,"language":"ru","idp_id":"e6f73a28-ff2e-4728-8f78-49eb74b20fce","external_id":"S-1-5-21-917267712-1342860078-1792151419-500","personal_tenant_id":"2f8ad2e2-28f2-11e7-aad1-5ffe2ad47151","business_types":[],"notifications":["maintenance","quota","reports","backup_error","backup_warning","backup_info","backup_daily_report","backup_critical","device_control_warning","certificate_management_error","certificate_management_warning","certificate_management_info"],"mfa_status":"setup_required"}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $user = $acronisClient->getUserClient()->get('948efcf2-b740-4c40-bb2d-4e4a46adfd87');

        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(Contact::class, $user->getContact());
        $this->assertInstanceOf(DateTimeImmutable::class, $user->getCreatedAt());
        $this->assertInstanceOf(DateTimeImmutable::class, $user->getUpdatedAt());
        $this->assertSame('948efcf2-b740-4c40-bb2d-4e4a46adfd87', $user->getId());
        $this->assertSame('0ef03214-6e47-4e50-87f2-a5955ba6095c', $user->getTenantId());
        $this->assertSame('2f8ad2e2-28f2-11e7-aad1-5ffe2ad47151', $user->getPersonalTenantId());
        $this->assertSame(2, $user->getVersion());
        $this->assertSame('mylogin', $user->getLogin());
        $this->assertTrue($user->isEnabled());
        $this->assertTrue($user->isActivated());
        $this->assertSame('ru', $user->getLanguage());
        $this->assertSame('setup_required', $user->getMfaStatus());
        $this->assertSame('2016-06-22 18:25:16', $user->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertSame('2016-06-22 18:25:16', $user->getUpdatedAt()->format('Y-m-d H:i:s'));
    }

    public function testGetByTenant(): void
    {
        $jsonResponse = '{"timestamp":"2016-06-22T18:25:16","items":[{"id":"fae84e50-0eef-11e7-bc3f-d39de3f5fe32","version":2,"tenant_id":"7ea1cf00-0ef0-11e7-8741-bb83f58f591f","login":"some_login_1","contact":{"id":"27f6f164-63dd-47df-b5b6-83a0fd117beb","created_at":"2020-05-19T11:50:00","updated_at":"2020-05-19T11:50:00","types":[],"email":"me@mysite.com","address1":"1440 River Drive #100","address2":"","country":"USA","state":"CA","zipcode":"12345","city":"Rivertown","phone":"123456789","firstname":"John","lastname":"Doe","title":"","website":"","industry":"","organization_size":"","email_confirmed":false,"aan":"","language":"en","fax":"123 Example Street"},"activated":true,"enabled":true,"created_at":"2016-06-22T18:25:16","updated_at":"2016-06-22T18:25:16","deleted_at":null,"language":"en","personal_tenant_id":"2f8ad2e2-28f2-11e7-aad1-5ffe2ad47151","business_types":[],"notifications":["maintenance","quota","reports","backup_error","backup_warning","backup_info","backup_daily_report","backup_critical","device_control_warning","certificate_management_error","certificate_management_warning","certificate_management_info"]},{"id":"76137b0e-0ef0-11e7-b5c2-1f8159df2571","version":2,"tenant_id":"7ea1cf00-0ef0-11e7-8741-bb83f58f591f","login":"some_login_2","contact":{"id":"27f6f164-63dd-47df-b5b6-83a0fd117beb","created_at":"2020-05-19T11:50:00","updated_at":"2020-05-19T11:50:00","types":[],"email":"me@mysite.com","address1":"1440 River Drive #100","address2":"","country":"USA","state":"CA","zipcode":"12345","city":"Rivertown","phone":"123456789","firstname":"John","lastname":"Smith","title":"","website":"","industry":"","organization_size":"","email_confirmed":false,"aan":"","fax":"123 Example Street","language":"en"},"activated":true,"enabled":true,"created_at":"2016-06-22T18:27:11","updated_at":"2016-06-22T18:25:16","deleted_at":null,"language":"ru","personal_tenant_id":"2f8ad2e2-28f2-11e7-aad1-5ffe2ad47151","business_types":["buyer"],"notifications":["maintenance","quota","reports","backup_error","backup_warning","backup_info","backup_daily_report","backup_critical","device_control_warning"]}]}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $userCollection = $acronisClient->getUserClient()->getByTenant('7ea1cf00-0ef0-11e7-8741-bb83f58f591f', 10);
        $firstUser = $userCollection->getItems()[0];

        $this->assertInstanceOf(UserCollection::class, $userCollection);
        $this->assertInstanceOf(User::class, $firstUser);
        $this->assertSame('2016-06-22 18:25:16', $userCollection->getTimestamp()->format('Y-m-d H:i:s'));
    }

    public function testCreate(): void
    {
        $contact = new Contact(
            [],
            'me@mysite.com',
            'John',
            'Doe'
        );
        $user = new User('0ef03214-6e47-4e50-87f2-a5955ba6095c');
        $user->setId('948efcf2-b740-4c40-bb2d-4e4a46adfd87')
            ->setPersonalTenantId('2f8ad2e2-28f2-11e7-aad1-5ffe2ad47151')
            ->setVersion(2)
            ->setLogin('mylogin')
            ->setEnabled(true)
            ->setActivated(true)
            ->setLanguage('ru')
            ->setMfaStatus('setup_required')
            ->setContact($contact);
        $jsonResponse = '{"id":"948efcf2-b740-4c40-bb2d-4e4a46adfd87","version":2,"tenant_id":"0ef03214-6e47-4e50-87f2-a5955ba6095c","login":"mylogin","contact":{"id":"27f6f164-63dd-47df-b5b6-83a0fd117beb","created_at":"2020-05-19T11:50:00","updated_at":"2020-05-19T11:50:00","types":[],"email":"me@mysite.com","address1":"1440 River Drive #100","address2":"","country":"USA","state":"CA","zipcode":"12345","city":"Rivertown","phone":"123456789","firstname":"John","lastname":"Doe","title":"","website":"","industry":"","organization_size":"","email_confirmed":false,"aan":"111111"},"activated":true,"enabled":true,"created_at":"2016-06-22T18:25:16","updated_at":"2016-06-22T18:25:16","deleted_at":null,"language":"ru","idp_id":"e6f73a28-ff2e-4728-8f78-49eb74b20fce","external_id":"S-1-5-21-917267712-1342860078-1792151419-500","personal_tenant_id":"2f8ad2e2-28f2-11e7-aad1-5ffe2ad47151","business_types":[],"notifications":["maintenance","quota","reports","backup_error","backup_warning","backup_info","backup_daily_report","backup_critical","device_control_warning","certificate_management_error","certificate_management_warning","certificate_management_info"],"mfa_status":"setup_required"}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $testCase = $this;
        $stack->push(function (callable $handler) use ($testCase, $user) {
            return function (RequestInterface $request, $options) use ($handler, $testCase, $user) {
                $body = $request->getBody()->getContents();
                $testCase->assertJson($body);

                $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                $this->assertArrayHasKey('contact', $decoded);
                $this->assertArrayNotHasKey('id', $decoded);
                $this->assertArrayNotHasKey('personal_tenant_id', $decoded);
                $this->assertArrayNotHasKey('version', $decoded);
                $this->assertArrayNotHasKey('created_at', $decoded);
                $this->assertArrayNotHasKey('updated_at', $decoded);
                $this->assertArrayNotHasKey('deleted_at', $decoded);
                $this->assertSame($user->getTenantId(), $decoded['tenant_id']);
                $this->assertSame($user->getLogin(), $decoded['login']);
                $this->assertSame($user->isEnabled(), $decoded['enabled']);
                $this->assertSame($user->isActivated(), $decoded['activated']);
                $this->assertSame($user->getLanguage(), $decoded['language']);
                $this->assertSame($user->getMfaStatus(), $decoded['mfa_status']);

                return $handler($request, $options);
            };
        });

        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $acronisClient->getUserClient()->create($user);
    }

    public function testUpdate(): void
    {
        $contact = new Contact(
            [],
            'me@mysite.com',
            'John',
            'Doe'
        );
        $user = new User('0ef03214-6e47-4e50-87f2-a5955ba6095c');
        $user->setId('948efcf2-b740-4c40-bb2d-4e4a46adfd87')
            ->setPersonalTenantId('2f8ad2e2-28f2-11e7-aad1-5ffe2ad47151')
            ->setVersion(2)
            ->setLogin('mylogin')
            ->setEnabled(true)
            ->setActivated(true)
            ->setLanguage('ru')
            ->setMfaStatus('setup_required')
            ->setContact($contact);
        $jsonResponse = '{"id":"948efcf2-b740-4c40-bb2d-4e4a46adfd87","version":2,"tenant_id":"0ef03214-6e47-4e50-87f2-a5955ba6095c","login":"mylogin","contact":{"id":"27f6f164-63dd-47df-b5b6-83a0fd117beb","created_at":"2020-05-19T11:50:00","updated_at":"2020-05-19T11:50:00","types":[],"email":"me@mysite.com","address1":"1440 River Drive #100","address2":"","country":"USA","state":"CA","zipcode":"12345","city":"Rivertown","phone":"123456789","firstname":"John","lastname":"Doe","title":"","website":"","industry":"","organization_size":"","email_confirmed":false,"aan":"111111"},"activated":true,"enabled":true,"created_at":"2016-06-22T18:25:16","updated_at":"2016-06-22T18:25:16","deleted_at":null,"language":"ru","idp_id":"e6f73a28-ff2e-4728-8f78-49eb74b20fce","external_id":"S-1-5-21-917267712-1342860078-1792151419-500","personal_tenant_id":"2f8ad2e2-28f2-11e7-aad1-5ffe2ad47151","business_types":[],"notifications":["maintenance","quota","reports","backup_error","backup_warning","backup_info","backup_daily_report","backup_critical","device_control_warning","certificate_management_error","certificate_management_warning","certificate_management_info"],"mfa_status":"setup_required"}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $testCase = $this;
        $stack->push(function (callable $handler) use ($testCase, $user) {
            return function (RequestInterface $request, $options) use ($handler, $testCase, $user) {
                $body = $request->getBody()->getContents();
                $testCase->assertJson($body);

                $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                $this->assertArrayHasKey('contact', $decoded);
                $this->assertArrayNotHasKey('created_at', $decoded);
                $this->assertArrayNotHasKey('updated_at', $decoded);
                $this->assertArrayNotHasKey('deleted_at', $decoded);
                $this->assertSame($user->getId(), $decoded['id']);
                $this->assertSame($user->getPersonalTenantId(), $decoded['personal_tenant_id']);
                $this->assertSame($user->getVersion(), $decoded['version']);

                return $handler($request, $options);
            };
        });

        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $acronisClient->getUserClient()->update($user);
    }

    public function testUpdatePassword(): void
    {
        $password = 'new-password';
        $user = new User('0ef03214-6e47-4e50-87f2-a5955ba6095c');
        $user->setId('948efcf2-b740-4c40-bb2d-4e4a46adfd87');

        $response = 'Password successfully set';

        $mockHandler = new MockHandler(
            [new Response(204, [], $response)]
        );
        $stack = HandlerStack::create($mockHandler);
        $testCase = $this;
        $stack->push(function (callable $handler) use ($testCase, $password) {
            return function (RequestInterface $request, $options) use ($handler, $testCase, $password) {
                $body = $request->getBody()->getContents();
                $testCase->assertJson($body);

                $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                $this->assertArrayHasKey('password', $decoded);
                $this->assertSame($password, $decoded['password']);

                return $handler($request, $options);
            };
        });

        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $acronisClient->getUserClient()->updatePassword($user, $password);
    }
}
