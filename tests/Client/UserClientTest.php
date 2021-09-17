<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Client;

use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\Client\RestClientInterface;
use SandwaveIo\Acronis\Client\UserClient;
use SandwaveIo\Acronis\Entity\Contact;
use SandwaveIo\Acronis\Entity\User;
use SandwaveIo\Acronis\Exception\AcronisException;

class UserClientTest extends TestCase
{
    /**
     * @var MockObject|RestClientInterface
     */
    private $restClient;

    /**
     * @var UserClient
     */
    private $userClient;

    protected function setUp(): void
    {
        $this->restClient = $this->createMock(RestClientInterface::class);
        $this->userClient = new UserClient($this->restClient);
    }

    public function testGet(): void
    {
        $userUid = 'numero-10';
        $tenantUid = 'numero-1';
        $personalTenantId = 'numero-2';

        $user = new User(
            $userUid,
            $tenantUid,
            $personalTenantId,
            1,
            'username',
            true,
            true,
            'en',
            'disabled',
            new DateTimeImmutable(),
            new DateTimeImmutable(),
            new Contact()
        );

        $this->restClient
            ->expects(self::once())
            ->method('getEntity')
            ->with(
                $this->equalTo(
                    sprintf('users/%s', $userUid)
                )
            )
            ->willReturn($user);

        $responeUser = $this->userClient->get($userUid);

        self::assertSame($userUid, $responeUser->getId());
    }

    public function testGetFailure(): void
    {
        $this->restClient
            ->expects(self::once())
            ->method('getEntity')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->userClient->get('numero-1');
    }

    public function testUpdate(): void
    {
        $contact = new Contact();
        $contact->setId('numero-1');
        $contact->setEmail('test@test.com');

        $userUid = 'numero-10';
        $tenantUid = 'numero-1';
        $personalTenantId = 'numero-2';

        $user = new User(
            $userUid,
            $tenantUid,
            $personalTenantId,
            1,
            'username',
            true,
            true,
            'en',
            'disabled',
            new DateTimeImmutable(),
            new DateTimeImmutable(),
            $contact
        );

        $this->restClient
            ->expects(self::once())
            ->method('put')
            ->with(
                $this->equalTo(
                    sprintf('users/%s', $user->getId())
                )
            )->willReturn($user);

        $updatedUser = $this->userClient->update($user);

        self::assertSame($user->getContact()->getEmail(), $updatedUser->getContact()->getEmail());
    }

    public function testUpdateFailure(): void
    {
        $userUid = 'numero-10';
        $tenantUid = 'numero-1';
        $personalTenantId = 'numero-2';

        $user = new User(
            $userUid,
            $tenantUid,
            $personalTenantId,
            1,
            'username',
            true,
            true,
            'en',
            'disabled',
            new DateTimeImmutable(),
            new DateTimeImmutable(),
            new Contact()
        );

        $this->restClient
            ->expects(self::once())
            ->method('put')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->userClient->update($user);
    }
}
