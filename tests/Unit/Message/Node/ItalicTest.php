<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\Italic;
use PHPUnit\Framework\TestCase;

final class ItalicTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertSame('italic', (new Italic())->getName());
    }
}
