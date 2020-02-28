<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class Mention extends Container
{
    public function __construct(string $type, string $id)
    {
        $this->addAttribute(new Attribute('type', $type));
        $this->addAttribute(new Attribute('id', $id));
    }

    public function getName(): string
    {
        return 'mention';
    }
}
