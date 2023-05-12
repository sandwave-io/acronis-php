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
    private ?string $bearerToken = null;

    private string $url;

    private string $clientId;

    private string $clientSecret;

    public function __construct(string $url, string $clientId, string $clientSecret)
    {
        $this->url = $url;
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
            $this->url . 'idp/token',
            [
                'auth'        => [$this->clientId, $this->clientSecret],
                'form_params' => ['grant_type' => 'client_credentials'],
            ]
        );

        return json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
    }
}
