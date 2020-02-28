<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\Strikethrough;
use PHPUnit\Framework\TestCase;

final class StrikethroughTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertSame('strikethrough', (new Strikethrough())->getName());
    }
}
