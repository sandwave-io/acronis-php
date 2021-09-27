<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

interface RestClientInterface
{
    public function getEntity(string $url, string $class): object;

    public function getRawData(string $url): string;

    public function post(string $url, object $data): object;

    public function postRaw(string $url, array $data): string;

    public function put(string $url, object $data): object;

    public function delete(string $url): void;
}
