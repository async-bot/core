<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Http\Exception;

use Amp\Http\Client\Request;
use AsyncBot\Core\Http\Exception\NetworkError;
use PHPUnit\Framework\TestCase;

final class NetworkErrorTest extends TestCase
{
    private Request $request;

    protected function setUp(): void
    {
        $this->request = new Request('https://example.com');
    }

    public function testConstructorFormatsMessageCorrectly(): void
    {
        $this->expectException(NetworkError::class);
        $this->expectExceptionMessage('Network error when requesting https://example.com over GET');

        throw new NetworkError($this->request);
    }

    public function testConstructorSetsCode(): void
    {
        $this->expectException(NetworkError::class);
        $this->expectExceptionCode(42);

        throw new NetworkError($this->request, 42);
    }
}
