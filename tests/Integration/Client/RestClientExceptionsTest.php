<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Integration\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\Client\RestClient;
use SandwaveIo\Acronis\Exception\AcronisException;
use SandwaveIo\Acronis\Exception\BadRequestException;
use SandwaveIo\Acronis\Exception\DeserializationException;
use SandwaveIo\Acronis\Exception\NetworkException;
use SandwaveIo\Acronis\Exception\ResourceNotFoundException;
use SandwaveIo\Acronis\Exception\ServerException as AcronisServerException;
use SandwaveIo\Acronis\Exception\UnauthorizedException;
use SandwaveIo\Acronis\RestClientFactory;

class RestClientExceptionsTest extends TestCase
{
    public function testUnauthorizedException(): void
    {
        $jsonResponse = '{"domain":"Access","reason":"InvalidClient","error":"invalid_client","error_description":"invalid client credentials, ..."}';
        $uri = '/';
        $mockHandler = new MockHandler(
            [
                new ClientException(
                    sprintf('`GET %s` resultated in a `401 Unauthorized` response: %s', $uri, $jsonResponse),
                    new Request(
                        'GET',
                        $uri
                    ),
                    new Response(401, [], $jsonResponse)
                ),
            ]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        self::expectException(UnauthorizedException::class);
        $restClient->getRawData($uri);
    }

    public function testResourceNotFoundException(): void
    {
        $jsonResponse = '{"error":{"code":404,"message":"Not found"}}';
        $uri = 'not-found';
        $mockHandler = new MockHandler(
            [
                new ClientException(
                    sprintf('`GET %s` resultated in a `404 Not found` response: %s', $uri, $jsonResponse),
                    new Request(
                        'GET',
                        $uri
                    ),
                    new Response(404, [], $jsonResponse)
                ),
            ]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        self::expectException(ResourceNotFoundException::class);
        $restClient->getRawData($uri);
    }

    public function testBadRequestException(): void
    {
        $jsonResponse = '{"error":{"details":{"info":"Bad Request"},"message":"Bad Request","domain":"PlatformAccountServer","context":{},"code":400}}';
        $uri = '/?invalidparam=1';
        $mockHandler = new MockHandler(
            [
                new ClientException(
                    sprintf('`GET %s` resultated in a `400 Bad Request` response: %s', $uri, $jsonResponse),
                    new Request(
                        'GET',
                        $uri
                    ),
                    new Response(400, [], $jsonResponse)
                ),
            ]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        self::expectException(BadRequestException::class);
        $restClient->getRawData($uri);
    }

    public function testNetworkException(): void
    {
        $uri = '/';
        $mockHandler = new MockHandler(
            [
                new TooManyRedirectsException(
                    sprintf('`GET %s` resultated in `Too many redirects`.', $uri),
                    new Request(
                        'GET',
                        $uri
                    )
                ),
            ]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        self::expectException(NetworkException::class);
        $restClient->getRawData($uri);
    }

    public function testServerException(): void
    {
        $response = 'Internal Server Error';
        $uri = '/';
        $mockHandler = new MockHandler(
            [
                new ServerException(
                    sprintf('`GET %s` resultated in a `500 Internal Server Error` response: %s', $uri, $response),
                    new Request(
                        'GET',
                        $uri
                    ),
                    new Response(500, [], $response)
                ),
            ]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        self::expectException(AcronisServerException::class);
        $restClient->getRawData($uri);
    }

    public function testRequestException(): void
    {
        $jsonResponse = '{"error":"unknown"}';
        $uri = '/';
        $mockHandler = new MockHandler(
            [
                new RequestException(
                    sprintf('`GET %s` resultated in a `400 Bad Request` response: %s', $uri, $jsonResponse),
                    new Request(
                        'GET',
                        $uri
                    ),
                    new Response(400, [], $jsonResponse)
                ),
            ]
        );
        $stack = HandlerStack::create($mockHandler);
        $guzzle = new Client(['handler' => $stack]);

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();
        $restClient = new RestClient($guzzle, $serializer);

        self::expectException(AcronisException::class);
        $restClient->getRawData($uri);
    }

    public function testDeserializationException(): void
    {
        $uri = '/';
        /** @var class-string $class */
        $class = 'SandwaveIo\Acronis\NotExistingClass';

        $serializerBuilder = new SerializerBuilder();
        $serializer = $serializerBuilder->build();

        $restClientFactory = new RestClientFactory('', '', '');

        $restClient = new RestClient($restClientFactory->create(), $serializer);

        self::expectException(DeserializationException::class);
        $restClient->getEntity($uri, $class);
    }
}
