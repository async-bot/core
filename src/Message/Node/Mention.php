<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class Mention extends Container
{
    public function __construct(string $type, string $id)
    {
        $this->addAttribute('type', $type);
        $this->addAttribute('id', $id);
    }

    public function getName(): string
    {
        return 'mention';
    }
}
