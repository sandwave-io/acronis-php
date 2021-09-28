<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\User;
use SandwaveIo\Acronis\Entity\UserCollection;
use SandwaveIo\Acronis\Exception\AcronisException;

final class UserClient
{
    private const USER_LIST = 'users';
    private const USER_BY_TENANT = 'users?subtree_root_tenant_id=%s&limit=%d&lod=%s';
    private const USER_DETAILS = 'users/%s';
    private const PASSWORD_UPDATE = 'users/%s/password';

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
        return $this->client->getEntity(sprintf(self::USER_DETAILS, $uuid), User::class);
    }

    public function getByTenant(string $tenantUuid, int $limit, string $levelOfDetails = 'full'): UserCollection
    {
        return $this->client->getEntity(
            sprintf(
                self::USER_BY_TENANT,
                $tenantUuid,
                $limit,
                $levelOfDetails
            ),
            UserCollection::class
        );
    }

    public function create(User $user): User
    {
        return $this->client->post(self::USER_LIST, $user, User::class);
    }

    public function update(User $user): User
    {
        return $this->client->put(sprintf(self::USER_DETAILS, $user->getId()), $user, User::class);
    }

    public function updatePassword(User $user, string $password): string
    {
        return $this->client->postRaw(sprintf(self::PASSWORD_UPDATE, $user->getId()), ['password' => $password]);
    }
}
