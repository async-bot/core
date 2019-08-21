<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Logger;

use AsyncBot\Core\Logger\Factory;
use AsyncBot\Core\Logger\Logger;
use PHPUnit\Framework\TestCase;

final class FactoryTest extends TestCase
{
    public function testBuildConsoleLoggerReturnsLoggerInstance(): void
    {
        $this->assertInstanceOf(Logger::class, (new Factory())->buildConsoleLogger());
    }
}
