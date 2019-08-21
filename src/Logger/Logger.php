<?php declare(strict_types=1);

namespace AsyncBot\Core\Logger;

use AsyncBot\Core\Driver;
use AsyncBot\Core\Plugin\Runnable;
use Psr\Log\LoggerInterface;

final class Logger
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function startManager(): void
    {
        $this->logger->info('Manager starting');
    }

    public function stopManager(): void
    {
        $this->logger->info('Manager stopped');
    }

    public function botRegistered(Driver $bot): void
    {
        $this->logger->info('Registered new bot', ['bot' => $bot]);
    }

    public function pluginRegistered(Runnable $plugin): void
    {
        $this->logger->info('Registered new plugin', ['plugin' => $plugin]);
    }

    public function botSentMessage(string $message): void
    {
        $this->logger->debug('Message sent', ['message' => $message]);
    }

    public function registeredListener(Runnable $plugin, string $event): void
    {
        $this->logger->info('New listener registered', ['plugin' => $plugin, 'event' => $event]);
    }

    /**
     * @param array<mixed> $context
     */
    public function error(string $message, array $context = []): void
    {
        $this->logger->error($message, $context);
    }
}
