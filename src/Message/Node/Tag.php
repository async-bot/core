<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class Tag extends Container
{
    public function getName(): string
    {
        return 'tag';
    }
}
