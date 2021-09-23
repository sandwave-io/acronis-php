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
use SandwaveIo\Acronis\Entity\Offering;
use SandwaveIo\Acronis\Entity\OfferingCollection;
use SandwaveIo\Acronis\Entity\OfferingQuota;
use SandwaveIo\Acronis\Entity\Tenant;

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
        $firstOffering = $offeringCollection->getOfferingItems()[0];

        $this->assertInstanceOf(OfferingCollection::class, $offeringCollection);
        $this->assertInstanceOf(Offering::class, $firstOffering);
        $this->assertInstanceOf(OfferingQuota::class, $firstOffering->getQuota());
        $this->assertInstanceOf(DateTimeImmutable::class, $offeringCollection->getTimestamp());
        $this->assertSame('2016-06-22 18:25:16', $offeringCollection->getTimestamp()->format('Y-m-d H:i:s'));
        $this->assertSame('f313ecf6-9256-4afd-9d47-72e032ee81d0', $firstOffering->getTenantId());
        $this->assertNull($firstOffering->getInfraId());
        $this->assertSame('a9fd8016-0e00-4ade-949e-6efe8672dac0', $firstOffering->getApplicationId());
        $this->assertSame('quantity', $firstOffering->getMeasurementUnit());
        $this->assertSame(1, $firstOffering->getStatus());
        $this->assertSame('count', $firstOffering->getType());
        $this->assertSame('standard', $firstOffering->getEdition());
        $this->assertSame('vms', $firstOffering->getName());
        $this->assertSame('vms', $firstOffering->getUsageName());
        $this->assertTrue($firstOffering->isLocked());

        $this->assertSame(10, $firstOffering->getQuota()->getValue());
        $this->assertSame(10, $firstOffering->getQuota()->getOverage());
        $this->assertSame(1486479690324, $firstOffering->getQuota()->getVersion());
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
        $offeringCollection->setOfferingItems([$offering]);

        $jsonResponse = '{"timestamp":"2016-06-22T18:25:16","items":[{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"vms","edition":"standard","usage_name":"vms","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":true,"type":"count","measurement_unit":"quantity","quota":{"value":10,"overage":10,"version":1486479690324}},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"dre_mobiles","edition":"disaster_recovery","usage_name":"mobiles","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":false,"type":"count","measurement_unit":"quantity","quota":{"value":10,"overage":10,"version":1486479690324}},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"local_storage","edition":null,"usage_name":"local_storage","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"type":"feature","measurement_unit":"n/a"},{"application_id":"a9fd8016-0e00-4ade-949e-6efe8672dac0","name":"adv_storage","edition":"advanced","usage_name":"storage","tenant_id":"f313ecf6-9256-4afd-9d47-72e032ee81d0","updated_at":"2016-06-22T18:25:16","deleted_at":null,"status":1,"locked":true,"type":"infra","measurement_unit":"bytes","infra_id":"ee978065-8caa-463d-82d7-47006376e7f2","quota":{"value":1000,"overage":null,"version":1486479690324}}]}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $testCase = $this;
        $stack->push(function (callable $handler) use ($testCase, $offeringCollection) {
            return function (RequestInterface $request, $options) use ($handler, $testCase, $offeringCollection) {
                $body = $request->getBody()->getContents();
                $testCase->assertJson($body);

                $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                $this->assertArrayNotHasKey('timestamp', $decoded);
                $this->assertArrayNotHasKey('items', $decoded);
                $this->assertArrayHasKey('offering_items', $decoded);

                $firstDecodedOffering = $decoded['offering_items'][0];
                $firstOffering = $offeringCollection->getOfferingItems()[0];
                $this->assertArrayNotHasKey('updated_at', $firstDecodedOffering);
                $this->assertArrayNotHasKey('deleted_at', $firstDecodedOffering);
                $this->assertArrayNotHasKey('infra_id', $firstDecodedOffering);
                $this->assertSame($firstOffering->getTenantId(), $firstDecodedOffering['tenant_id']);
                $this->assertSame($firstOffering->getApplicationId(), $firstDecodedOffering['application_id']);
                $this->assertSame($firstOffering->getMeasurementUnit(), $firstDecodedOffering['measurement_unit']);
                $this->assertSame($firstOffering->getStatus(), $firstDecodedOffering['status']);
                $this->assertSame($firstOffering->getType(), $firstDecodedOffering['type']);
                $this->assertSame($firstOffering->getEdition(), $firstDecodedOffering['edition']);
                $this->assertSame($firstOffering->getName(), $firstDecodedOffering['name']);
                $this->assertSame($firstOffering->getUsageName(), $firstDecodedOffering['usage_name']);
                $this->assertTrue($firstDecodedOffering['locked']);

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
