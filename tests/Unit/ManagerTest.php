<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit;

use Amp\Success;
use AsyncBot\Core\Driver;
use AsyncBot\Core\Logger\Logger;
use AsyncBot\Core\Manager;
use AsyncBot\Core\Plugin\Runnable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

final class ManagerTest extends TestCase
{
    private MockObject $psrLogger;

    private Manager $manager;

    protected function setUp(): void
    {
        $this->psrLogger = $this->createMock(LoggerInterface::class);

        $this->manager = new Manager(new Logger($this->psrLogger));
    }

    public function testRunLogsStartAndStop(): void
    {
        $this->psrLogger
            ->expects($this->exactly(2))
            ->method('info')
            ->withConsecutive(['Manager starting'], ['Manager stopped'])
        ;

        $this->manager->run();
    }

    public function testRegisterBotLogs(): void
    {
        $this->psrLogger
            ->expects($this->once())
            ->method('info')
            ->with('Registered new bot')
        ;

        $this->manager->registerBot($this->createMock(Driver::class));
    }

    public function testRunStartsBots(): void
    {
        $bot1 = $this->createMock(Driver::class);
        $bot2 = $this->createMock(Driver::class);

        $bot1
            ->expects($this->once())
            ->method('start')
            ->willReturn(new Success())
        ;

        $bot2
            ->expects($this->once())
            ->method('start')
            ->willReturn(new Success())
        ;

        $this->manager->registerBot($bot1);
        $this->manager->registerBot($bot2);

        $this->manager->run();
    }

    public function testRegisterPluginLogs(): void
    {
        $this->psrLogger
            ->expects($this->once())
            ->method('info')
            ->with('Registered new plugin')
        ;

        $this->manager->registerPlugin($this->createMock(Runnable::class));
    }

    public function testRegisterStartsRunnables(): void
    {
        $runnable1 = $this->createMock(Runnable::class);
        $runnable2 = $this->createMock(Runnable::class);

        $runnable1
            ->expects($this->once())
            ->method('run')
            ->willReturn(new Success())
        ;

        $runnable2
            ->expects($this->once())
            ->method('run')
            ->willReturn(new Success())
        ;

        $this->manager->registerPlugin($runnable1);
        $this->manager->registerPlugin($runnable2);

        $this->manager->run();
    }
}
