<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class OrderedList extends ListType
{
    public function getName(): string
    {
        return 'ol';
    }
}
