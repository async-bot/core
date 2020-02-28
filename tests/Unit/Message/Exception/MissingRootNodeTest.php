<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Exception;

use AsyncBot\Core\Message\Exception\MissingRootNode;
use PHPUnit\Framework\TestCase;

final class MissingRootNodeTest extends TestCase
{
    public function testConstructorFormatsMessageCorrectly(): void
    {
        $this->expectException(MissingRootNode::class);
        $this->expectExceptionMessage('Expected root <message> node');

        throw new MissingRootNode();
    }
}
