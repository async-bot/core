<?php declare(strict_types=1);

namespace AsyncBot\Core\Http;

use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Promise;

interface WebHookListener
{
    /**
     * @return Promise<Response>
     */
    public function __invoke(Request $request): Promise;
}
