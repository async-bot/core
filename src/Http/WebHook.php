<?php declare(strict_types=1);

namespace AsyncBot\Core\Http;

use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Promise;

final class WebHook
{
    private string $method;

    private string $path;

    private WebHookListener $listener;

    public function __construct(string $method, string $path, WebHookListener $listener)
    {
        $this->method   = $method;
        $this->path     = $path;
        $this->listener = $listener;
    }

    public function matchesRequest(Request $request): bool
    {
        if ($request->getMethod() !== $this->method) {
            return false;
        }

        if ($request->getUri()->getPath() !== $this->path) {
            return false;
        }

        return true;
    }

    /**
     * @return Promise<Response>
     */
    public function run(Request $request): Promise
    {
        return ($this->listener)($request);
    }
}
