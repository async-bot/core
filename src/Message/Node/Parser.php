<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

use AsyncBot\Core\Message\Exception\InvalidNode;
use AsyncBot\Core\Message\Exception\NodeMissingAttribute;

final class Parser
{
    private \XMLReader $xmlReader;

    public function __construct()
    {
        $this->xmlReader = new \XMLReader();
    }

    public function parse(string $nodeContents): Node
    {
        $this->xmlReader->xml($nodeContents);

        $this->xmlReader->read();

        switch (strtolower($this->xmlReader->name)) {
            case 'message':
                return $this->parseMessageNode();

            case 'bold':
                return $this->parseBoldNode();

            case 'italic':
                return $this->parseItalicNode();

            case 'strikethrough':
                return $this->parseStrikethroughNode();

            case 'url':
                return $this->parseUrlNode();

            case 'code':
                return $this->parseCodeNode();

            case 'mention':
                return $this->parseMentionNode();

            case 'blockquote':
                return $this->parseBlockQuoteNode();

            case 'ul':
                return $this->parseUnorderedListNode();

            case 'ol':
                return $this->parseOrderedListNode();

            case 'li':
                return $this->parseListItemNode();

            case 'tag':
                return $this->parseTagNode();

            case 'separator':
                return $this->parseSeparatorNode();

            default:
                throw new InvalidNode($this->xmlReader->name);
        }
    }

    private function parseNodeContainer(Container $container): Container
    {
        while ($this->xmlReader->read()) {
            if ($this->xmlReader->depth > 1) {
                continue;
            }

            $textNodeTypes = [
                \XMLReader::TEXT,
                \XMLReader::CDATA,
                \XMLReader::WHITESPACE,
                \XMLReader::SIGNIFICANT_WHITESPACE,
            ];

            if (in_array($this->xmlReader->nodeType, $textNodeTypes, true)) {
                $container->appendNode(new Text(html_entity_decode($this->xmlReader->value)));

                continue;
            }

            if ($this->xmlReader->nodeType !== \XMLReader::ELEMENT) {
                continue;
            }

            $container->appendNode((new self())->parse($this->xmlReader->readOuterXml()));
        }

        return $container;
    }

    private function parseMessageNode(): Node
    {
        $message = new Message();

        if ($this->xmlReader->getAttribute('replyTo')) {
            $message->setReplyAttribute(
                html_entity_decode($this->xmlReader->getAttribute('type')),
                html_entity_decode($this->xmlReader->getAttribute('replyTo')),
            );
        }

        return $this->parseNodeContainer($message);
    }

    private function parseBoldNode(): Node
    {
        return $this->parseNodeContainer(new Bold());
    }

    private function parseItalicNode(): Node
    {
        return $this->parseNodeContainer(new Italic());
    }

    private function parseStrikethroughNode(): Node
    {
        return $this->parseNodeContainer(new Strikethrough());
    }

    private function parseUrlNode(): Node
    {
        if ($this->xmlReader->getAttribute('href') === null) {
            throw new NodeMissingAttribute('url', 'href');
        }

        return $this->parseNodeContainer(new Url(html_entity_decode($this->xmlReader->getAttribute('href'))));
    }

    private function parseCodeNode(): Node
    {
        return $this->parseNodeContainer(new Code());
    }

    private function parseMentionNode(): Node
    {
        return $this->parseNodeContainer(new Mention(
            html_entity_decode($this->xmlReader->getAttribute('type')),
            html_entity_decode($this->xmlReader->getAttribute('id')),
        ));
    }

    private function parseBlockQuoteNode(): Node
    {
        return $this->parseNodeContainer(new BlockQuote());
    }

    private function parseUnorderedListNode(): Node
    {
        return $this->parseNodeContainer(new UnorderedList());
    }

    private function parseOrderedListNode(): Node
    {
        return $this->parseNodeContainer(new OrderedList());
    }

    private function parseListItemNode(): Node
    {
        return $this->parseNodeContainer(new ListItem());
    }

    private function parseTagNode(): Node
    {
        $tagNode = new Tag();

        if ($this->xmlReader->getAttribute('type')) {
            $tagNode->addAttribute(new Attribute('type', html_entity_decode($this->xmlReader->getAttribute('type'))));
        }

        return $this->parseNodeContainer($tagNode);
    }

    private function parseSeparatorNode(): Node
    {
        return new Separator();
    }
}
