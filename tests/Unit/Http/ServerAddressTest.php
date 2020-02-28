<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Http;

use AsyncBot\Core\Http\ServerAddress;
use PHPUnit\Framework\TestCase;

final class ServerAddressTest extends TestCase
{
    private ServerAddress $serverAddress;

    public function setUp(): void
    {
        $this->serverAddress = new ServerAddress('0.0.0.0', 80);
    }

    public function testGetAddress(): void
    {
        $this->assertSame('0.0.0.0', $this->serverAddress->getAddress());
    }

    public function testGetPort(): void
    {
        $this->assertSame(80, $this->serverAddress->getPort());
    }

    public function testToString(): void
    {
        $this->assertSame('0.0.0.0:80', $this->serverAddress->toString());
    }
}
