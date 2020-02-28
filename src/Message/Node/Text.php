<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class Text implements Node
{
    private string $content;

    public function __construct(string $content)
    {
        $this->content = htmlspecialchars($content, ENT_QUOTES|ENT_SUBSTITUTE, 'utf-8');
    }

    public function toString(): string
    {
        return $this->content;
    }
}
