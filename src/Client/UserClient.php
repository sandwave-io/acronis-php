<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\User;
use SandwaveIo\Acronis\Exception\AcronisException;

class UserClient
{
    private const USER_DETAILS = 'users/%s';

    /**
     * @var RestClientInterface
     */
    private $client;

    public function __construct(RestClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws AcronisException
     */
    public function get(string $uuid): User
    {
        /** @var User $user */
        $user = $this->client->getEntity(sprintf(self::USER_DETAILS, $uuid), User::class);

        return $user;
    }

    public function update(User $user): User
    {
        /** @var User $updatedUser */
        $updatedUser = $this->client->put(sprintf(self::USER_DETAILS, $user->getId()), $user);

        return $updatedUser;
    }
}
