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
}
