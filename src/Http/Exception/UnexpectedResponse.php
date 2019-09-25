<?php declare(strict_types=1);

namespace AsyncBot\Core\Http\Exception;

use Amp\Http\Client\Request;
use AsyncBot\Core\Exception\Exception;

class UnexpectedResponse extends Exception
{
    public function __construct(Request $request)
    {
        parent::__construct(
            sprintf('Unexpected response when requesting %s over %s', $request->getUri(), $request->getMethod()),
        );
    }
}
