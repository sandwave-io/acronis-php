<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;

class RestClientFactory implements RestClientFactoryInterface
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $clientIdentifier;

    public function __construct(string $uri, string $clientIdentifier, string $clientSecret)
    {
        $this->uri = $uri;
        $this->clientSecret = $clientSecret;
        $this->clientIdentifier = $clientIdentifier;
    }

    public function create(): ClientInterface
    {
        $stack = HandlerStack::create();
        $stack->push(
            new BearerTokenMiddleware(
                $this->uri,
                $this->clientIdentifier,
                $this->clientSecret
            )
        );

        return new Client(
            [
                'handler' => $stack,
                'auth' => 'oauth',
                'base_uri' => $this->uri,
            ]
        );
    }
}
