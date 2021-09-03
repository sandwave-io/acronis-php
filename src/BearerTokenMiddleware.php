<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Psr\Http\Message\RequestInterface;

class BearerTokenMiddleware
{
    /**
     * @var string|null
     */
    private $bearerToken;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    public function __construct(string $uri, string $clientId, string $clientSecret)
    {
        $this->uri = $uri;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function __invoke(callable $handler): Closure
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            if ($this->bearerToken === null) {
                $response = $this->getBearerToken();
                $this->bearerToken = $response->access_token;
            }

            return $handler(
                $request->withAddedHeader('Authorization', 'Bearer ' . $this->bearerToken),
                $options
            );
        };
    }

    /**
     * @throws JsonException
     * @throws GuzzleException
     *
     * @return mixed
     */
    private function getBearerToken()
    {
        $client = new Client();
        $response = $client->request(
            'POST',
            $this->uri . 'idp/token',
            [
                'auth'        => [$this->clientId, $this->clientSecret],
                'form_params' => ['grant_type' => 'client_credentials'],
            ]
        );

        return json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
    }
}
