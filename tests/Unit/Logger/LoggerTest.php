<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Logger;

use AsyncBot\Core\Driver;
use AsyncBot\Core\Logger\Logger;
use AsyncBot\Core\Plugin\Runnable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

final class LoggerTest extends TestCase
{
    private MockObject $psrLogger;

    private Logger $logger;

    protected function setUp(): void
    {
        $this->psrLogger = $this->createMock(LoggerInterface::class);

        $this->logger = new Logger($this->psrLogger);
    }

    public function testStartManager(): void
    {
        $this->psrLogger
            ->expects($this->once())
            ->method('info')
            ->with('Manager starting')
        ;

        $this->logger->startManager();
    }

    public function testStopManager(): void
    {
        $this->psrLogger
            ->expects($this->once())
            ->method('info')
            ->with('Manager stopped')
        ;

        $this->logger->stopManager();
    }

    public function testBotRegistered(): void
    {
        $this->psrLogger
            ->expects($this->once())
            ->method('info')
            ->with(
                'Registered new bot',
                $this->logicalAnd($this->arrayHasKey('bot'), $this->containsOnlyInstancesOf(Driver::class)),
            )
        ;

        $this->logger->botRegistered($this->createMock(Driver::class));
    }

    public function testPluginRegistered(): void
    {
        $this->psrLogger
            ->expects($this->once())
            ->method('info')
            ->with(
                'Registered new plugin',
                $this->logicalAnd($this->arrayHasKey('plugin'), $this->containsOnlyInstancesOf(Runnable::class)),
            )
        ;

        $this->logger->pluginRegistered($this->createMock(Runnable::class));
    }

    public function testBotSentMessage(): void
    {
        $this->psrLogger
            ->expects($this->once())
            ->method('debug')
            ->with('Message sent', ['message' => 'The message'])
        ;

        $this->logger->botSentMessage('The message');
    }

    public function testRegisteredListener(): void
    {
        $this->psrLogger
            ->expects($this->once())
            ->method('info')
            ->with(
                'New listener registered',
                $this->logicalAnd($this->arrayHasKey('plugin'), $this->arrayHasKey('event')),
            )
        ;

        $this->logger->registeredListener($this->createMock(Runnable::class), 'someEvent');
    }

    public function testError(): void
    {
        $this->psrLogger
            ->expects($this->once())
            ->method('error')
            ->with('The error message', ['key' => 'value'])
        ;

        $this->logger->error('The error message', ['key' => 'value']);
    }
}
