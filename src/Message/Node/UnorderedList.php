<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

use AsyncBot\Core\Message\Exception\InvalidChildNode;

final class UnorderedList extends Container
{
    public function appendNode(Node $node): void
    {
        if (!$node instanceof ListItem) {
            throw new InvalidChildNode($this, $node);
        }

        $this->nodes[] = $node;
    }

    public function getName(): string
    {
        return 'ul';
    }
}
