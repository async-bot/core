<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Exception\InvalidChildNode;
use AsyncBot\Core\Message\Node\ListItem;
use AsyncBot\Core\Message\Node\OrderedList;
use AsyncBot\Core\Message\Node\Text;
use PHPUnit\Framework\TestCase;

final class OrderedListTest extends TestCase
{
    private OrderedList $orderedList;

    public function setUp(): void
    {
        $this->orderedList = new OrderedList();
    }

    public function testGetName(): void
    {
        $this->assertSame('ol', $this->orderedList->getName());
    }

    public function testAppendNodeThrowsOnInvalidNode(): void
    {
        $this->expectException(InvalidChildNode::class);
        $this->expectExceptionMessage(
            'Node of type AsyncBot\Core\Message\Node\OrderedList cannot have a child node of type AsyncBot\Core\Message\Node\Text',
        );

        $this->orderedList->appendNode(new Text('test'));
    }

    public function testAppendNodeAddsChildNode(): void
    {
        $this->orderedList->appendNode(new ListItem());

        $this->assertSame('<ol><li></li></ol>', $this->orderedList->toString());
    }
}
