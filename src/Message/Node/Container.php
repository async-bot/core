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

    /**
     * @return array<Node>
     */
    public function getChildren(): array
    {
        return $this->nodes;
    }

    public function hasAttribute(string $name): bool
    {
        return isset($this->attributes[$name]);
    }

    public function getAttribute(string $name): ?string
    {
        if (!isset($this->attributes[$name])) {
            return null;
        }

        return $this->attributes[$name];
    }

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
