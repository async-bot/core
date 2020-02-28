<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Message\Node;

use AsyncBot\Core\Message\Node\Mention;
use PHPUnit\Framework\TestCase;

final class MentionTest extends TestCase
{
    private Mention $mention;

    public function setUp(): void
    {
        $this->mention = new Mention('stackoverflow', 'peehaa');
    }

    public function testGetName(): void
    {
        $this->assertSame('mention', $this->mention->getName());
    }

    public function testConstructorSetsTypeAndIdCorrectly(): void
    {
        $this->assertSame('<mention type="stackoverflow" id="peehaa"></mention>', $this->mention->toString());
    }
}
