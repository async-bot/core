<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class Attribute
{
    private string $name;

    private string $value;

    public function __construct(string $name, string $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function toString(): string
    {
        return sprintf('%s="%s"', $this->name, $this->value);
    }
}
