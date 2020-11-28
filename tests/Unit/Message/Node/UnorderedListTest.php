<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\ListItem;
use AsyncBot\Core\Message\Node\UnorderedList;
use PHPUnit\Framework\TestCase;

final class UnorderedListTest extends TestCase
{
    private UnorderedList $unorderedList;

    protected function setUp(): void
    {
        $this->unorderedList = new UnorderedList();
    }

    public function testGetName(): void
    {
        $this->assertSame('ul', $this->unorderedList->getName());
    }

    public function testAppendNodeAddsChildNode(): void
    {
        $this->unorderedList->appendNode(new ListItem());

        $this->assertSame('<ul><li></li></ul>', $this->unorderedList->toString());
    }
}
