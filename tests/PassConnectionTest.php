<?php
declare(strict_types=1);

namespace particleflux\PMConnection\tests;

use particleflux\PMConnection\exceptions\ConnectionFailedException;
use particleflux\PMConnection\exceptions\InvalidConfigException;
use particleflux\PMConnection\PassConnection;

class PassConnectionTest extends TestCase
{
    public function testGetPassword(): void
    {
        $connection = new PassConnection();
        $password = $connection->getPassword('foo');
        $this->assertEquals('my-secret-password', $password);

        $password = $connection->getPassword('bar');
        $this->assertEquals('my-"other"-password', $password);

        $this->expectException(ConnectionFailedException::class);
        $connection->getPassword('non-existing');
    }

    public function testGetUser(): void
    {
        $connection = new PassConnection();
        $user = $connection->getUser('foo');
        $this->assertEquals('my-user', $user);

        $this->expectException(ConnectionFailedException::class);
        $connection->getUser('bar');
    }

    public function testGetUserNonStandard(): void
    {
        $connection = new PassConnection([
            'userAttribute' => 'wtf',
        ]);
        $user = $connection->getUser('baz');
        $this->assertEquals('wtf-user', $user);

        $this->expectException(ConnectionFailedException::class);
        $connection->getUser('foo');
    }

    public function testBadConfig(): void
    {
        $this->expectException(InvalidConfigException::class);
        new PassConnection([
            'no no no' => 'you killed kenny!',
        ]);
    }
}
