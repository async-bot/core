<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message;

use AsyncBot\Core\Message\Exception\MissingRootNode;
use AsyncBot\Core\Message\Node\Message;
use AsyncBot\Core\Message\Parser;
use PHPUnit\Framework\TestCase;

final class ParserTest extends TestCase
{
    public function testParseThrowsOnMissingRootNode(): void
    {
        $this->expectException(MissingRootNode::class);

        (new Parser())->parse('<ul><li/></ul>');
    }

    public function testParseParsesMessage(): void
    {
        $this->assertInstanceOf(Message::class, (new Parser())->parse('<message/>'));
    }

    public function testParseParsesMessageWithDifferentCasing(): void
    {
        $this->assertInstanceOf(Message::class, (new Parser())->parse('<MESSAGE/>'));
    }
}
