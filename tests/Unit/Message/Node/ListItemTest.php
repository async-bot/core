<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\ListItem;
use PHPUnit\Framework\TestCase;

final class ListItemTest extends TestCase
{
    public function testGetName(): void
    {
        $this->assertSame('li', (new ListItem())->getName());
    }
}
