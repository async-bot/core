<?php declare(strict_types=1);

namespace AsyncBot\Core\Http\Exception;

use Amp\Http\Client\Request;
use AsyncBot\Core\Exception\Exception;

final class NetworkError extends Exception
{
    public function __construct(Request $request, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Network error when requesting %s over %s', $request->getUri(), $request->getMethod()),
            $code,
            $previous,
        );
    }
}
