<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Exception;

use AsyncBot\Core\Message\Exception\NodeMissingAttribute;
use PHPUnit\Framework\TestCase;

final class NodeMissingAttributeTest extends TestCase
{
    public function testConstructorFormatsMessageCorrectly(): void
    {
        $this->expectException(NodeMissingAttribute::class);
        $this->expectExceptionMessage('Node node is missing the required attr attribute');

        throw new NodeMissingAttribute('node', 'attr');
    }
}
