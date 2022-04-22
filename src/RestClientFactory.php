<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;

final class RestClientFactory implements RestClientFactoryInterface
{
    private string $url;

    private string $clientSecret;

    private string $clientIdentifier;

    public function __construct(string $url, string $clientIdentifier, string $clientSecret)
    {
        $this->url = $url;
        $this->clientSecret = $clientSecret;
        $this->clientIdentifier = $clientIdentifier;
    }

    public function create(): ClientInterface
    {
        $stack = HandlerStack::create();
        $stack->push(
            new BearerTokenMiddleware(
                $this->url,
                $this->clientIdentifier,
                $this->clientSecret
            )
        );

        return new Client(
            [
                'handler' => $stack,
                'auth' => 'oauth',
                'base_uri' => $this->url,
            ]
        );
    }
}
