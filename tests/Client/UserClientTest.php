<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Client;

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

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        $this->restClient = $this->createMock(RestClientInterface::class);
        $this->userClient = new UserClient($this->restClient);
        $this->user = new User('tenant-uid');
    }

    public function testGet(): void
    {
        $userUid = 'numero-10';

        $this->user->setId($userUid);

        $this->restClient
            ->expects(self::once())
            ->method('getEntity')
            ->with(
                $this->equalTo(
                    sprintf('users/%s', $userUid)
                )
            )
            ->willReturn($this->user);

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

    public function testUpdatePassword(): void
    {
        $password = 'password';

        $this->restClient
            ->expects(self::once())
            ->method('postRaw')
            ->with(
                $this->equalTo(
                    sprintf('users/%s/password', $this->user->getId())
                )
            )->willReturn('');

        $response = $this->userClient->updatePassword($this->user, $password);

        self::assertEmpty($response);
    }

    public function testUpdate(): void
    {
        $contact = new Contact(
            ['primary'],
            'john.doe@domain.com',
            'John',
            'Doe'
        );

        $this->user->setContact($contact);

        $this->restClient
            ->expects(self::once())
            ->method('put')
            ->with(
                $this->equalTo(
                    sprintf('users/%s', $this->user->getId())
                )
            )->willReturn($this->user);

        $updatedUser = $this->userClient->update($this->user);

        self::assertSame($this->user->getContact()->getEmail(), $updatedUser->getContact()->getEmail());
    }

    public function testUpdateFailure(): void
    {
        $this->restClient
            ->expects(self::once())
            ->method('put')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->userClient->update($this->user);
    }
}
