<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Http;

use Amp\Http\Server\Driver\Client;
use Amp\Http\Server\Request;
use Amp\Success;
use AsyncBot\Core\Http\WebHook;
use AsyncBot\Core\Http\WebHookListener;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;
use function Amp\Promise\wait;

final class WebHookTest extends TestCase
{
    private WebHook $webHook;

    public function setUp(): void
    {
        $this->webHook = new WebHook('GET', '/endpoint', $this->createMock(WebHookListener::class));
    }

    public function testMatchesRequestReturnsFalseWhenMethodDoesNotMatch(): void
    {
        $request = new Request(
            $this->createMock(Client::class),
            'POST',
            $this->createMock(UriInterface::class),
        );

        $this->assertFalse($this->webHook->matchesRequest($request));
    }

    public function testMatchesRequestReturnsFalseWhenPathDoesNotMatch(): void
    {
        $uri = $this->createMock(UriInterface::class);

        $uri
            ->method('getPath')
            ->willReturn('/not-endpoint')
        ;

        $request = new Request($this->createMock(Client::class), 'GET', $uri);

        $this->assertFalse($this->webHook->matchesRequest($request));
    }

    public function testMatchesRequestReturnsTrueWhenMatches(): void
    {
        $uri = $this->createMock(UriInterface::class);

        $uri
            ->method('getPath')
            ->willReturn('/endpoint')
        ;

        $request = new Request($this->createMock(Client::class), 'GET', $uri);

        $this->assertTrue($this->webHook->matchesRequest($request));
    }

    public function testRunRunsListener(): void
    {
        $listener = $this->createMock(WebHookListener::class);

        $listener
            ->expects($this->once())
            ->method('__invoke')
            ->with($this->isInstanceOf(Request::class))
            ->willReturn(new Success())
        ;

        $webHook = new WebHook('GET', '/endpoint', $listener);

        $request = new Request(
            $this->createMock(Client::class),
            'POST',
            $this->createMock(UriInterface::class),
        );

        wait($webHook->run($request));
    }
}
