<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\RequestOptions;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use ReflectionClass;
use ReflectionException;
use SandwaveIo\Acronis\Exception\AcronisException;
use SandwaveIo\Acronis\Exception\BadRequestException;
use SandwaveIo\Acronis\Exception\DeserializationException;
use SandwaveIo\Acronis\Exception\NetworkException;
use SandwaveIo\Acronis\Exception\ResourceNotFoundException;
use SandwaveIo\Acronis\Exception\ServerException as AcronisServerException;
use SandwaveIo\Acronis\Exception\UnauthorizedException;

final class RestClient implements RestClientInterface
{
    private const REQUEST_TIMEOUT = 5;

    private ClientInterface $client;
    private SerializerInterface $serializer;

    public function __construct(ClientInterface $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    /**
     * @template T of object
     *
     * @param string          $url
     * @param class-string<T> $returnType
     *
     * @throws AcronisException
     *
     * @return T
     */
    public function getEntity(string $url, string $returnType): object
    {
        $this->assertValidClass($returnType);
        $json = $this->get($url);

        return $this->serializer->deserialize($json, $returnType, 'json');
    }

    public function getRawData(string $url): string
    {
        return $this->get($url);
    }

    /**
     * @template T
     *
     * @param string          $url
     * @param object          $data
     * @param class-string<T> $returnType
     *
     * @return T
     */
    public function post(string $url, object $data, string $returnType)
    {
        $this->assertValidClass($returnType);
        $json = $this->serializer->serialize($data, 'json', SerializationContext::create()->setGroups(['create_data']));

        $response = $this->request('POST', $url, [
            'body' => $json,
            'headers' => [
                'Content-type' => 'application/json; charset=utf-8',
            ],
        ]);

        return $this->serializer->deserialize($response->getBody()->getContents(), $returnType, 'json');
    }

    public function postRaw(string $url, array $data): string
    {
        $json = json_encode($data);

        $response = $this->request('POST', $url, [
            'body' => $json,
            'headers' => [
                'Content-type' => 'application/json; charset=utf-8',
            ],
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @template T
     *
     * @param string          $url
     * @param object          $data
     * @param class-string<T> $returnType
     *
     * @return T
     */
    public function put(string $url, object $data, string $returnType)
    {
        $this->assertValidClass($returnType);
        $json = $this->serializer->serialize($data, 'json', SerializationContext::create()->setGroups(['update_data']));

        $response = $this->request('PUT', $url, [
            'body' => $json,
            'headers' => [
                'Content-type' => 'application/json; charset=utf-8',
            ],
        ]);

        return $this->serializer->deserialize($response->getBody()->getContents(), $returnType, 'json');
    }

    public function delete(string $url): void
    {
        $this->request('DELETE', $url);
    }

    private function get(string $url): string
    {
        $response = $this->request('GET', $url);

        return $response->getBody()->getContents();
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $options
     *
     * @throws AcronisException
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

    /**
     * @template T
     *
     * @param class-string<T> $className
     */
    private function assertValidClass(string $className): void
    {
        try {
            new ReflectionClass($className);
        } catch (ReflectionException $exception) {
            throw new DeserializationException(sprintf('Supplied classname %s does not exist', $className));
        }
    }

    private function convertException(Exception $exception): AcronisException
    {
        $message = $exception instanceof RequestException ? $this->convertMessage($exception) : $exception->getMessage();

        if ($exception instanceof ConnectException || $exception instanceof TooManyRedirectsException) {
            return new NetworkException($message, 0, $exception);
        }

        if ($exception instanceof ServerException) {
            // error 500 range
            return new AcronisServerException($message, 0, $exception);
        }

        if ($exception instanceof ClientException) {
            if ($exception->getCode() === 404) {
                return new ResourceNotFoundException($message, 0, $exception);
            }

            if ($exception->getCode() === 401) {
                return new UnauthorizedException($message, 0, $exception);
            }

            // 400 range
            return new BadRequestException($message, 0, $exception);
        }

        return new AcronisException($message, 0, $exception);
    }

    private function convertMessage(RequestException $exception): string
    {
        $response = $exception->getResponse();

        if (null === $response) {
            return $exception->getMessage();
        }

        $body = $response->getBody()->getContents();
        try {
            $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            $decoded = null;
        }

        if (null === $decoded) {
            return $exception->getMessage();
        }

        if (isset($decoded['error'])) {
            if (isset($decoded['error']['details'])) {
                if (isset($decoded['error']['details']['info']) && is_string($decoded['error']['details']['info'])) {
                    return $decoded['error']['details']['info'];
                }
            }
            if (isset($decoded['error']['message']) && is_string($decoded['error']['message'])) {
                return $decoded['error']['message'];
            }
        }

        if (isset($decoded['error_description']) && is_string($decoded['error_description'])) {
            return $decoded['error_description'];
        }

        return $exception->getMessage();
    }
}
