<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Integration\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\AcronisClient;
use SandwaveIo\Acronis\Client\RestClient;
use SandwaveIo\Acronis\Entity\SearchResult;
use SandwaveIo\Acronis\Entity\SearchResultCollection;

class SearchClientTest extends TestCase
{
    public function testSearch(): void
    {
        $jsonResponse = '{"items":[{"obj_type":"tenant","kind":"customer","id":"bfe40b45-7d3f-4183-a655-afa62b59b383","parent_id":"bfe40b45-7d3f-4183-a655-afa62b59b383","path":["my tenant","some child"],"name":"Example group","first_name":null,"last_name":null},{"obj_type":"user","id":"1c234e69-5469-424a-a6d1-ff5658b387a6","parent_id":"1c234e69-5469-424a-a6d1-ff5658b387a6","path":["my tenant","some child","Example group"],"login":"admin@example.com","first_name":"Example","last_name":"Admin"}]}';

        $mockHandler = new MockHandler(
            [new Response(200, [], $jsonResponse)]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        $acronisClient = new AcronisClient($restClient);
        $searchResultCollection = $acronisClient->getSearchClient()->search('fa6859a9-f5e1-4faf-a56c-5a0ae866dc4f', 'example');
        $firstSearchResult = $searchResultCollection->getItems()[0];

        self::assertInstanceOf(SearchResultCollection::class, $searchResultCollection);
        self::assertInstanceOf(SearchResult::class, $firstSearchResult);
        self::assertSame('bfe40b45-7d3f-4183-a655-afa62b59b383', $firstSearchResult->getId());
        self::assertSame('tenant', $firstSearchResult->getType());
        self::assertSame('customer', $firstSearchResult->getKind());
        self::assertSame('bfe40b45-7d3f-4183-a655-afa62b59b383', $firstSearchResult->getParentId());
        self::assertSame(['my tenant', 'some child'], $firstSearchResult->getPath());
        self::assertSame('Example group', $firstSearchResult->getName());
        self::assertNull($firstSearchResult->getFirstname());
        self::assertNull($firstSearchResult->getLastname());
    }
}
