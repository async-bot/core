<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\Code;
use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertSame('code', (new Code())->getName());
    }
}
