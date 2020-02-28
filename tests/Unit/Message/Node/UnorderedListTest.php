<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Exception\InvalidChildNode;
use AsyncBot\Core\Message\Node\ListItem;
use AsyncBot\Core\Message\Node\Text;
use AsyncBot\Core\Message\Node\UnorderedList;
use PHPUnit\Framework\TestCase;

final class UnorderedListTest extends TestCase
{
    private UnorderedList $unorderedList;

    public function setUp(): void
    {
        $this->unorderedList = new UnorderedList();
    }

    public function testGetName(): void
    {
        $this->assertSame('ul', $this->unorderedList->getName());
    }

    public function testAppendNodeThrowsOnInvalidNode(): void
    {
        $this->expectException(InvalidChildNode::class);
        $this->expectExceptionMessage(
            'Node of type AsyncBot\Core\Message\Node\UnorderedList cannot have a child node of type AsyncBot\Core\Message\Node\Text',
        );

        $this->unorderedList->appendNode(new Text('test'));
    }

    public function testAppendNodeAddsChildNode(): void
    {
        $this->unorderedList->appendNode(new ListItem());

        $this->assertSame('<ul><li></li></ul>', $this->unorderedList->toString());
    }
}
