<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class UnorderedList extends ListType
{
    public function getName(): string
    {
        return 'ul';
    }
}
