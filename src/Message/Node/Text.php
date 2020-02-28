<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class Text implements Node
{
    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function toString(): string
    {
        return $this->content;
    }
}
