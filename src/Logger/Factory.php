<?php declare(strict_types=1);

namespace AsyncBot\Core\Logger;

use Amp\ByteStream\ResourceOutputStream;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Monolog\Logger as MonoLogger;

final class Factory
{
    public static function buildConsoleLogger(): Logger
    {
        $handler = new StreamHandler(new ResourceOutputStream(\STDOUT));
        $handler->setFormatter(new ConsoleFormatter());

        $logger = new MonoLogger('amp-bot');
        $logger->pushHandler($handler);

        return new Logger($logger);
    }
}
