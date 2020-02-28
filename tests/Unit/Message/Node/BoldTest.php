<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\Bold;
use PHPUnit\Framework\TestCase;

final class BoldTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertSame('bold', (new Bold())->getName());
    }
}
