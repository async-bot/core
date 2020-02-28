<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Exception;

use AsyncBot\Core\Message\Node\Node;

final class InvalidChildNode extends InvalidMessage
{
    public function __construct(Node $parentNode, Node $childNode)
    {
        parent::__construct(
            sprintf(
                'Node of type %s cannot have a child node of type %s',
                get_class($parentNode),
                get_class($childNode),
            ),
        );
    }
}
