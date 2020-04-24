<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\ListItem;
use AsyncBot\Core\Message\Node\OrderedList;
use PHPUnit\Framework\TestCase;

final class OrderedListTest extends TestCase
{
    private OrderedList $orderedList;

    protected function setUp(): void
    {
        $this->orderedList = new OrderedList();
    }

    public function testGetName(): void
    {
        $this->assertSame('ol', $this->orderedList->getName());
    }

    public function testAppendNodeAddsChildNode(): void
    {
        $this->orderedList->appendNode(new ListItem());

        $this->assertSame('<ol><li></li></ol>', $this->orderedList->toString());
    }
}
