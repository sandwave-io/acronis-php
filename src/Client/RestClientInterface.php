<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Exception\AcronisException;

interface RestClientInterface
{
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
    public function getEntity(string $url, string $returnType): object;

    /**
     * @throws AcronisException
     */
    public function getRawData(string $url): string;

    /**
     * @template T
     *
     * @param string          $url
     * @param object          $data
     * @param class-string<T> $returnType
     *
     * @return T
     */
    public function post(string $url, object $data, string $returnType);

    /**
     * @throws AcronisException
     */
    public function postRaw(string $url, array $data): string;

    /**
     * @template T
     *
     * @param string          $url
     * @param object          $data
     * @param class-string<T> $returnType
     *
     * @return T
     */
    public function put(string $url, object $data, string $returnType);

    /**
     * @throws AcronisException
     */
    public function delete(string $url): void;
}
