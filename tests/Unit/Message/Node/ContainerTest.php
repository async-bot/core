<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\Message;
use AsyncBot\Core\Message\Node\Text;
use PHPUnit\Framework\TestCase;

final class ContainerTest extends TestCase
{
    public function testToString(): void
    {
        $this->assertSame('<message></message>', (new Message())->toString());
    }

    public function testToWithChildNodes(): void
    {
        $message = new Message();

        $message->appendNode(new Text('test'));

        $this->assertSame('<message>test</message>', $message->toString());
    }

    public function testToWithAttributes(): void
    {
        $message = new Message();

        $message->addAttribute('attr1', 'value1');
        $message->addAttribute('attr2', 'value2');

        $this->assertSame('<message attr1="value1" attr2="value2"></message>', $message->toString());
    }

    public function testGetChildren(): void
    {
        $message = new Message();

        $message->appendNode(new Text('test'));

        $this->assertCount(1, $message->getChildren());
        $this->assertInstanceOf(Text::class, $message->getChildren()[0]);
    }

    public function testHasAttributeReturnsFalseWhenItDoesNotExists(): void
    {
        $this->assertFalse((new Message())->hasAttribute('nonExisting'));
    }

    public function testHasAttributeReturnsTrueWhenItDoesExist(): void
    {
        $message = new Message();

        $message->setReplyAttribute('stackoverflow', '48714113');

        $this->assertTrue($message->hasAttribute('type'));
    }

    public function testGetAttributeReturnsNullWhenAttributeDoesNotExists(): void
    {
        $this->assertNull((new Message())->getAttribute('nonExisting'));
    }

    public function testGetAttributeReturnsAttributeWhenItExists(): void
    {
        $message = new Message();

        $message->setReplyAttribute('stackoverflow', '48714113');

        $this->assertSame('stackoverflow', $message->getAttribute('type'));
    }
}
