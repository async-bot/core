<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

abstract class Container implements Node
{
    /** @var array<Node>  */
    protected array $nodes = [];

    /** @var array<string,string> */
    private array $attributes = [];

    public function addAttribute(string $name, string $value): void
    {
        $this->attributes[$name] = $value;
    }

    public function appendNode(Node $node): void
    {
        $this->nodes[] = $node;
    }

    abstract public function getName(): string;

    public function toString(): string
    {
        $nodeContents = '';

        foreach ($this->nodes as $node) {
            $nodeContents .= $node->toString();
        }

        if (!$this->attributes) {
            return sprintf('<%s>%s</%s>', $this->getName(), $nodeContents, $this->getName());
        }

        $attributes = [];

        foreach ($this->attributes as $name => $value) {
            $attributes[] = sprintf('%s="%s"', $name, $value);
        }

        return sprintf('<%s %s>%s</%s>', $this->getName(), implode(' ', $attributes), $nodeContents, $this->getName());
    }
}
