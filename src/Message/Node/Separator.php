<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class Separator implements Node
{
    public function toString(): string
    {
        return '<separator/>';
    }
}
