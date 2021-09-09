<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\RequestOptions;
use InvalidArgumentException;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use ReflectionClass;
use ReflectionException;
use SandwaveIo\Acronis\Exception\AcronisException;

final class RestClient implements RestClientInterface
{
    private const REQUEST_TIMEOUT = 5;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(ClientInterface $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    /**
     * @template T of object
     *
     * @param string          $url
     * @param class-string<T> $class
     *
     * @throws AcronisException
     *
     * @return T
     */
    public function getEntity(string $url, string $class): object
    {
        $reflectionClass = $this->getDataObject($class);
        $item = $this->get($url);

        /** @var T $data */
        $data = $this->serializer->deserialize($item, $reflectionClass->getName(), 'json');

        return $data;
    }

    /**
     * @template T
     *
     * @param string          $url
     * @param class-string<T> $class
     *
     * @return T[]
     */
    public function getEntityCollection(string $url, string $class): array
    {
        $reflectionClass = $this->getDataObject($class)->getName();
        $items = $this->getItemsRawData($url);

        /**
         * @var class-string<T>
         */
        $class = 'array<' . $reflectionClass . '>';

        return $this->serializer->deserialize($items, $class, 'json');
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function getRawData(string $url): string
    {
        return $this->getItemsRawData($url);
    }

    /**
     * @template T of object
     *
     * @param string $url
     * @param object $data
     *
     * @return T
     */
    public function post(string $url, object $data): object
    {
        $json = $this->serializer->serialize($data, 'json', SerializationContext::create()->setGroups(['create_data']));

        $response = $this->request('POST', $url, [
            'body' => $json,
            'headers' => [
                'Content-type' => 'application/json; charset=utf-8',
            ],
        ]);

        $class = get_class($data);

        /** @var T $responseData */
        $responseData = $this->serializer->deserialize($response->getBody()->getContents(), $class, 'json');

        return $responseData;
    }

    /**
     * @template T of object
     *
     * @param string $url
     * @param object $data
     *
     * @return T
     */
    public function put(string $url, object $data): object
    {
        $json = $this->serializer->serialize($data, 'json', SerializationContext::create()->setGroups(['update_data']));

        $response = $this->request('PUT', $url, [
            'body' => $json,
            'headers' => [
                'Content-type' => 'application/json; charset=utf-8',
            ],
        ]);

        $class = get_class($data);

        /** @var T $responseData */
        $responseData = $this->serializer->deserialize($response->getBody()->getContents(), $class, 'json');

        return $responseData;
    }

    public function delete(string $url): void
    {
        $this->request('delete', $url);
    }

    private function get(string $url): string
    {
        $response = $this->request('GET', $url);

        return $response->getBody()->getContents();
    }

    /**
     * @throws AcronisException
     */
    private function getItemsRawData(string $url): string
    {
        try {
            $data = json_decode($this->get($url), false, 512, JSON_THROW_ON_ERROR);

            if (! isset($data->items)) {
                throw new AcronisException('Items key is missing.');
            }

            return json_encode($data->items, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw $this->convertException($exception);
        }
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $options
     *
     * @return ResponseInterface
     */
    private function request(string $method, string $url, array $options = []): ResponseInterface
    {
        try {
            $response = $this->client->request($method, $url, array_merge($options, $this->getRequestOptions()));
        } catch (TransferException $exception) {
            throw $this->convertException($exception);
        }

        return $response;
    }

    private function getRequestOptions(): array
    {
        return [
            RequestOptions::CONNECT_TIMEOUT => self::REQUEST_TIMEOUT,
        ];
    }

    private function convertException(Exception $exception): AcronisException
    {
        return new AcronisException($exception->getMessage(), $exception->getCode(), $exception);
    }

    /**
     * @template T
     *
     * @param class-string<T> $class
     *
     * @return ReflectionClass
     */
    private function getDataObject(string $class): ReflectionClass
    {
        try {
            $reflectionClass = new ReflectionClass($class);
        } catch (ReflectionException $exception) {
            throw new InvalidArgumentException(sprintf('Supplied classname %s does not exist', $class));
        }

        return $reflectionClass;
    }
}
