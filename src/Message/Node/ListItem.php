<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class ListItem extends Container
{
    public function getName(): string
    {
        return 'li';
    }
}
