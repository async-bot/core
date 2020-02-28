<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\BlockQuote;
use PHPUnit\Framework\TestCase;

final class BlockQuoteTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertSame('blockquote', (new BlockQuote())->getName());
    }
}
