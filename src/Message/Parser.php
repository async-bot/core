<?php declare(strict_types=1);

namespace AsyncBot\Core\Message;

use AsyncBot\Core\Message\Exception\MissingRootNode;
use AsyncBot\Core\Message\Node\Message;
use AsyncBot\Core\Message\Node\Parser as NodeParser;

final class Parser
{
    public function parse(string $message): Message
    {
        $xmlReader = new \XMLReader();

        $xmlReader->xml($message);

        $xmlReader->read();

        if ($xmlReader->nodeType !== \XMLReader::ELEMENT || strtolower($xmlReader->name) !== 'message') {
            throw new MissingRootNode();
        }

        return (new NodeParser())->parse($xmlReader->readOuterXml());
    }
}
