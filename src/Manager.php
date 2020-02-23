<?php declare(strict_types=1);

namespace AsyncBot\Core;

use Amp\Loop;
use AsyncBot\Core\Http\Server;
use AsyncBot\Core\Logger\Logger;
use AsyncBot\Core\Plugin\Runnable;

final class Manager
{
    private Logger $logger;

    private ?Server $webServer;

    /** @var array<Driver> */
    private array $bots = [];

    /** @var array<Runnable> */
    private array $runnables = [];

    public function __construct(Logger $logger, ?Server $webServer = null)
    {
        $this->logger    = $logger;
        $this->webServer = $webServer;
    }

    public function registerBot(Driver $bot): self
    {
        $this->logger->botRegistered($bot);

        $this->bots[] = $bot;

        return $this;
    }

    public function registerPlugin(Runnable $runnable): self
    {
        $this->logger->pluginRegistered($runnable);

        $this->runnables[] = $runnable;

        return $this;
    }

    public function run(): void
    {
        $this->logger->startManager();

        Loop::run(function () {
            if ($this->webServer) {
                yield $this->webServer->start();
            }

            foreach ($this->bots as $bot) {
                yield $bot->start();
            }

            foreach ($this->runnables as $runnable) {
                yield $runnable->run();
            }
        });

        $this->logger->stopManager();
    }
}
