<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Http\Exception;

use Amp\Http\Client\Request;
use AsyncBot\Core\Http\Exception\UnexpectedResponse;
use PHPUnit\Framework\TestCase;

final class UnexpectedResponseTest extends TestCase
{
    public function testConstructorFormatsMessageCorrectly(): void
    {
        $this->expectException(UnexpectedResponse::class);
        $this->expectExceptionMessage('Unexpected response when requesting https://example.com over GET');

        throw new UnexpectedResponse(new Request('https://example.com'));
    }
}
