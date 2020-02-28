<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class Italic extends Container
{
    public function getName(): string
    {
        return 'italic';
    }
}
