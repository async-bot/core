<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\Message;
use PHPUnit\Framework\TestCase;

final class MessageTest extends TestCase
{
    private Message $mention;

    protected function setUp(): void
    {
        $this->mention = new Message();
    }

    public function testGetName(): void
    {
        $this->assertSame('message', $this->mention->getName());
    }

    public function testSetReplyAttribute(): void
    {
        $this->mention->setReplyAttribute('stackoverflow', '48712454');

        $this->assertSame('<message type="stackoverflow" replyTo="48712454"></message>', $this->mention->toString());
    }
}
