<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\Attribute;
use PHPUnit\Framework\TestCase;

final class AttributeTest extends TestCase
{
    private Attribute $attribute;

    public function setUp(): void
    {
        $this->attribute = new Attribute('name', 'value');
    }

    public function testGetName(): void
    {
        $this->assertSame('name', $this->attribute->getName());
    }

    public function testGetValue(): void
    {
        $this->assertSame('value', $this->attribute->getValue());
    }

    public function testToString(): void
    {
        $this->assertSame('name="value"', $this->attribute->toString());
    }
}
