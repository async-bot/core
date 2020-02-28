<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Exception;

final class InvalidNode extends InvalidMessage
{
    public function __construct(string $nodeName)
    {
        parent::__construct(
            sprintf('Node of type %s is not valid', $nodeName),
        );
    }
}
