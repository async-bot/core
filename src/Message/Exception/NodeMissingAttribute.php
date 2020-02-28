<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Exception;

final class NodeMissingAttribute extends InvalidMessage
{
    public function __construct(string $node, string $attribute)
    {
        parent::__construct(
            sprintf('Node %s is missing the required %s attribute', $node, $attribute),
        );
    }
}
