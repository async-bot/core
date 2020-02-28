<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Exception\InvalidChildNode;
use AsyncBot\Core\Message\Node\Bold;
use AsyncBot\Core\Message\Node\ListItem;
use AsyncBot\Core\Message\Node\ListType;
use AsyncBot\Core\Message\Node\Text;
use AsyncBot\Core\Message\Node\UnorderedList;
use PHPUnit\Framework\TestCase;

final class ListTypeTest extends TestCase
{
    private ListType $list;

    public function setUp(): void
    {
        $this->list = new UnorderedList();
    }

    public function testAppendNodeThrowsOnInvalidNode(): void
    {
        $this->expectException(InvalidChildNode::class);
        $this->expectExceptionMessage(
            'Node of type list cannot have a child node of type AsyncBot\Core\Message\Node\Bold',
        );

        $this->list->appendNode(new Bold());
    }

    public function testAppendNodeDoesNotThrowOnTextNode(): void
    {
        $this->list->appendNode(new Text(''));

        $this->assertSame('<ul></ul>', $this->list->toString());
    }

    public function testAppendNodeAddsChildNode(): void
    {
        $this->list->appendNode(new ListItem());

        $this->assertSame('<ul><li></li></ul>', $this->list->toString());
    }
}
