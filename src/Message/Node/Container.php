<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

abstract class Container implements Node
{
    /** @var array<Node>  */
    protected array $nodes = [];

    /** @var array<string,Attribute> */
    private array $attributes = [];

    public function addAttribute(Attribute $attribute): self
    {
        $this->attributes[$attribute->getName()] = $attribute;

        return $this;
    }

    public function prependNode(Node $node): self
    {
        array_unshift($this->nodes, $node);

        return $this;
    }

    public function appendNode(Node $node): self
    {
        $this->nodes[] = $node;

        return $this;
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

    public function getAttribute(string $name): ?Attribute
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
            if ($node instanceof Text) {
                $nodeContents .= htmlentities($node->toString(), ENT_QUOTES|ENT_SUBSTITUTE|ENT_XML1, 'utf-8');

                continue;
            }

            $nodeContents .= $node->toString();
        }

        if (!$this->attributes) {
            return sprintf('<%s>%s</%s>', $this->getName(), $nodeContents, $this->getName());
        }

        $attributes = array_map(fn (Attribute $attribute) => $attribute->toString(), $this->attributes);

        return sprintf('<%s %s>%s</%s>', $this->getName(), implode(' ', $attributes), $nodeContents, $this->getName());
    }
}
