<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

interface RestClientInterface
{
    public function getAsData(string $url, string $class): object;

    public function getAsArrayOfData(string $url, string $class): array;

    public function getRawData(string $url): string;

    public function post(string $url, object $data): object;

    public function put(string $url, object $data): object;

    public function delete(string $url): void;
}
