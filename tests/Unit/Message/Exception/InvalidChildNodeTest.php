<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Exception;

use AsyncBot\Core\Message\Exception\InvalidChildNode;
use AsyncBot\Core\Message\Node\Bold;
use PHPUnit\Framework\TestCase;

final class InvalidChildNodeTest extends TestCase
{
    public function testConstructorFormatsMessageCorrectly(): void
    {
        $this->expectException(InvalidChildNode::class);
        $this->expectExceptionMessage(
            'Node of type list cannot have a child node of type AsyncBot\Core\Message\Node\Bold',
        );

        throw new InvalidChildNode(new Bold());
    }
}
