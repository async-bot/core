<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class Bold extends Container
{
    public function getName(): string
    {
        return 'bold';
    }
}
