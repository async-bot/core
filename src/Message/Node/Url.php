<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class Url extends Container
{
    public function __construct(string $href)
    {
        $this->addAttribute('href', $href);
    }

    public function getName(): string
    {
        return 'url';
    }
}
