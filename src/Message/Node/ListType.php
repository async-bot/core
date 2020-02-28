<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

use AsyncBot\Core\Message\Exception\InvalidChildNode;

abstract class ListType extends Container
{
    public function appendNode(Node $node): self
    {
        if ($node instanceof Text) {
            return $this;
        }

        if (!$node instanceof ListItem) {
            throw new InvalidChildNode($node);
        }

        $this->nodes[] = $node;

        return $this;
    }
}
