<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\Url;
use PHPUnit\Framework\TestCase;

final class UrlTest extends TestCase
{
    private Url $url;

    protected function setUp(): void
    {
        $this->url = new Url('https://example.com');
    }

    public function testGetName(): void
    {
        $this->assertSame('url', $this->url->getName());
    }

    public function testConstructorSetsHrefCorrectly(): void
    {
        $this->assertSame('<url href="https://example.com"></url>', $this->url->toString());
    }
}
