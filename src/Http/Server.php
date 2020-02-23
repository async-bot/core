<?php declare(strict_types=1);

namespace AsyncBot\Core\Http;

use Amp\ByteStream\ResourceOutputStream;
use Amp\Http\Server\HttpServer;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler\CallableRequestHandler;
use Amp\Http\Server\Response;
use Amp\Http\Status;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Amp\Promise;
use Amp\Socket\Server as SocketServer;
use Monolog\Logger;
use function Amp\call;

final class Server
{
    /** @var array<ServerAddress> */
    private array $addresses = [];

    /** @var array<WebHook> */
    private array $webHooks = [];

    public function __construct(ServerAddress ...$addresses)
    {
        $this->addresses = $addresses;
    }

    public function registerWebHook(WebHook $webHook): void
    {
        $this->webHooks[] = $webHook;
    }

    /**
     * @return Promise<null>
     */
    public function start(): Promise
    {
        return call(function () {
            $servers = array_map(
                fn (ServerAddress $address) => SocketServer::listen($address->toString()),
                $this->addresses,
            );

            $server = new HttpServer($servers, new CallableRequestHandler(function (Request $request) {
                foreach ($this->webHooks as $webHook) {
                    if (!$webHook->matchesRequest($request)) {
                        continue;
                    }

                    return yield $webHook->run($request);
                }

                return new Response(Status::NOT_FOUND);
            }), $this->buildLogger());

            yield $server->start();
        });
    }

    private function buildLogger(): Logger
    {
        $logHandler = new StreamHandler(new ResourceOutputStream(STDOUT));

        $logHandler->setFormatter(new ConsoleFormatter());

        $logger = new Logger('http-server');

        $logger->pushHandler($logHandler);

        return $logger;
    }
}
