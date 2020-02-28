<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\Text;
use PHPUnit\Framework\TestCase;

final class TextTest extends TestCase
{
    public function testToString(): void
    {
        $this->assertSame('test', (new Text('test'))->toString());
    }
}
