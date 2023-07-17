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
use SandwaveIo\Acronis\Entity\Offering;
use SandwaveIo\Acronis\Entity\OfferingCollection;
use SandwaveIo\Acronis\Entity\OfferingQuota;

class OfferingClientTest extends TestCase
{
    public function testGet(): void
    {
        $jsonResponse = '{"timestamp":"2016-06-22T18:25:16","items":[{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"vms","edition":"standard","usage_name":"vms","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":true,"type":"count","measurement_unit":"quantity","quota":{"value":10,"overage":10,"version":1486479690324}},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"dre_mobiles","edition":"disaster_recovery","usage_name":"mobiles","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":false,"type":"count","measurement_unit":"quantity","quota":{"value":10,"overage":10,"version":1486479690324}},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"local_storage","edition":null,"usage_name":"local_storage","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"type":"feature","measurement_unit":"n/a"},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"adv_storage","edition":"advanced","usage_name":"storage","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":true,"type":"infra","measurement_unit":"bytes","infra_id":"ee978065-8caa-463d-82d7-47006376e7f2","quota":{"value":1000,"overage":null,"version":1486479690324}}]}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $offeringCollection = $acronisClient->getOfferingClient()->get('fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f');
        $firstOffering = $offeringCollection->getItems()[0];

        self::assertInstanceOf(OfferingCollection::class, $offeringCollection);
        self::assertInstanceOf(Offering::class, $firstOffering);
        self::assertInstanceOf(OfferingQuota::class, $firstOffering->getQuota());
        self::assertInstanceOf(DateTimeImmutable::class, $offeringCollection->getTimestamp());
        self::assertSame('2016-06-22 18:25:16', $offeringCollection->getTimestamp()->format('Y-m-d H:i:s'));
        self::assertSame('f313ecf6-9256-4afd-9d47-72e032ee81d0', $firstOffering->getTenantId());
        self::assertNull($firstOffering->getInfraId());
        self::assertSame('a9fd8016-0e00-4ade-949e-6efe8672dac0', $firstOffering->getApplicationId());
        self::assertSame('quantity', $firstOffering->getMeasurementUnit());
        self::assertSame(1, $firstOffering->getStatus());
        self::assertSame('count', $firstOffering->getType());
        self::assertSame('standard', $firstOffering->getEdition());
        self::assertSame('vms', $firstOffering->getName());
        self::assertSame('vms', $firstOffering->getUsageName());
        self::assertTrue($firstOffering->isLocked());

        self::assertSame(10, $firstOffering->getQuota()->getValue());
        self::assertSame(10, $firstOffering->getQuota()->getOverage());
        self::assertSame(1486479690324, $firstOffering->getQuota()->getVersion());
    }

    public function testUpdate(): void
    {
        $offeringQuota = new OfferingQuota(10, 10, 1486479690324);
        $offering = new Offering(
            'f313ecf6-9256-4afd-9d47-72e032ee81d0',
            null,
            'a9fd8016-0e00-4ade-949e-6efe8672dac0',
            'quantity',
            1,
            'count',
            'standard',
            'vms',
            'vms',
            true,
            $offeringQuota
        );
        $offeringCollection = new OfferingCollection();
        $offeringCollection->setItems([$offering]);

        $jsonResponse = '{"timestamp":"2016-06-22T18:25:16","items":[{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"vms","edition":"standard","usage_name":"vms","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":true,"type":"count","measurement_unit":"quantity","quota":{"value":10,"overage":10,"version":1486479690324}},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"dre_mobiles","edition":"disaster_recovery","usage_name":"mobiles","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":false,"type":"count","measurement_unit":"quantity","quota":{"value":10,"overage":10,"version":1486479690324}},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"local_storage","edition":null,"usage_name":"local_storage","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"type":"feature","measurement_unit":"n/a"},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"adv_storage","edition":"advanced","usage_name":"storage","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":true,"type":"infra","measurement_unit":"bytes","infra_id":"ee978065-8caa-463d-82d7-47006376e7f2","quota":{"value":1000,"overage":null,"version":1486479690324}}]}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $stack->push(function (callable $handler) use ($offeringCollection) {
            return function (RequestInterface $request, $options) use ($handler, $offeringCollection) {
                $body = $request->getBody()->getContents();
                self::assertJson($body);

                $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                self::assertArrayNotHasKey('timestamp', $decoded);
                self::assertArrayNotHasKey('items', $decoded);
                self::assertArrayHasKey('offering_items', $decoded);

                $firstDecodedOffering = $decoded['offering_items'][0];
                $firstOffering = $offeringCollection->getItems()[0];
                self::assertArrayNotHasKey('updated_at', $firstDecodedOffering);
                self::assertArrayNotHasKey('deleted_at', $firstDecodedOffering);
                self::assertArrayNotHasKey('infra_id', $firstDecodedOffering);
                self::assertSame($firstOffering->getTenantId(), $firstDecodedOffering['tenant_id']);
                self::assertSame($firstOffering->getApplicationId(), $firstDecodedOffering['application_id']);
                self::assertSame($firstOffering->getMeasurementUnit(), $firstDecodedOffering['measurement_unit']);
                self::assertSame($firstOffering->getStatus(), $firstDecodedOffering['status']);
                self::assertSame($firstOffering->getType(), $firstDecodedOffering['type']);
                self::assertSame($firstOffering->getEdition(), $firstDecodedOffering['edition']);
                self::assertSame($firstOffering->getName(), $firstDecodedOffering['name']);
                self::assertSame($firstOffering->getUsageName(), $firstDecodedOffering['usage_name']);
                self::assertTrue($firstDecodedOffering['locked']);

                return $handler($request, $options);
            };
        });

        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $acronisClient->getOfferingClient()->update('f313ecf6-9256-4afd-9d47-72e032ee81d0', $offeringCollection);
    }
}
