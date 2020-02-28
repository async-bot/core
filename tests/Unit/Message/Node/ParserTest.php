<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Exception\InvalidNode;
use AsyncBot\Core\Message\Exception\NodeMissingAttribute;
use AsyncBot\Core\Message\Node\BlockQuote;
use AsyncBot\Core\Message\Node\Bold;
use AsyncBot\Core\Message\Node\Code;
use AsyncBot\Core\Message\Node\Italic;
use AsyncBot\Core\Message\Node\ListItem;
use AsyncBot\Core\Message\Node\Mention;
use AsyncBot\Core\Message\Node\Message;
use AsyncBot\Core\Message\Node\OrderedList;
use AsyncBot\Core\Message\Node\Parser;
use AsyncBot\Core\Message\Node\Strikethrough;
use AsyncBot\Core\Message\Node\UnorderedList;
use AsyncBot\Core\Message\Node\Url;
use PHPUnit\Framework\TestCase;

final class ParserTest extends TestCase
{
    private Parser $parser;

    public function setUp(): void
    {
        $this->parser = new Parser();
    }

    public function testParseThrowsOnInvalidNode(): void
    {
        $this->expectException(InvalidNode::class);
        $this->expectExceptionMessage('Node of type invalid is not valid');

        $this->parser->parse('<invalid/>');
    }

    public function testParseParsesMessageNode(): void
    {
        $this->assertInstanceOf(Message::class, $this->parser->parse('<message/>'));
    }

    public function testParseParsesMessageReplyAttributes(): void
    {
        $message = $this->parser->parse('<message type="stackoverflow" replyTo="48712454"/>');

        $this->assertSame('<message type="stackoverflow" replyTo="48712454"></message>', $message->toString());
    }

    public function testParseParsesBoldNode(): void
    {
        $this->assertInstanceOf(Bold::class, $this->parser->parse('<bold/>'));
    }

    public function testParseParsesItalicNode(): void
    {
        $this->assertInstanceOf(Italic::class, $this->parser->parse('<italic/>'));
    }

    public function testParseParsesStrikethroughNode(): void
    {
        $this->assertInstanceOf(Strikethrough::class, $this->parser->parse('<strikethrough/>'));
    }

    public function testParseParsesUrlNode(): void
    {
        $this->assertInstanceOf(Url::class, $this->parser->parse('<url href="https://example.com"/>'));
    }

    public function testParseParsesUrlAndThrowsOnMissingHrefAttribute(): void
    {
        $this->expectException(NodeMissingAttribute::class);
        $this->expectExceptionMessage('Node url is missing the required href attribute');

        $this->parser->parse('<url/>');
    }

    public function testParseParsesUrlHrefAttributeNode(): void
    {
        $url = $this->parser->parse('<url href="https://example.com"/>');

        $this->assertSame('<url href="https://example.com"></url>', $url->toString());
    }

    public function testParseParsesCodeNode(): void
    {
        $this->assertInstanceOf(Code::class, $this->parser->parse('<code/>'));
    }

    public function testParseParsesMentionNode(): void
    {
        $this->assertInstanceOf(Mention::class, $this->parser->parse('<mention type="stackoverflow" id="peehaa"/>'));
    }

    public function testParseParsesMentionAttributesNode(): void
    {
        $mention = $this->parser->parse('<mention type="stackoverflow" id="peehaa"/>');

        $this->assertSame('<mention type="stackoverflow" id="peehaa"></mention>', $mention->toString());
    }

    public function testParseParsesBlockquoteNode(): void
    {
        $this->assertInstanceOf(BlockQuote::class, $this->parser->parse('<blockquote/>'));
    }

    public function testParseParsesUnorderedListNode(): void
    {
        $this->assertInstanceOf(UnorderedList::class, $this->parser->parse('<ul/>'));
    }

    public function testParseParsesOrderedListNode(): void
    {
        $this->assertInstanceOf(OrderedList::class, $this->parser->parse('<ol/>'));
    }

    public function testParseParsesListItemNode(): void
    {
        $this->assertInstanceOf(ListItem::class, $this->parser->parse('<li/>'));
    }

    public function testParseParsesCDataAsTextNode(): void
    {
        $this->assertSame('<li>test</li>', $this->parser->parse('<li><![CDATA[test]]></li>')->toString());
    }

    public function testParseParsesRecursively(): void
    {
        $messageString = '<message><ul><li>test</li></ul></message>';

        $message = $this->parser->parse($messageString);

        $this->assertInstanceOf(Message::class, $message);
        $this->assertSame($messageString, $message->toString());
    }
}
