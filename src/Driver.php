<?php declare(strict_types=1);

namespace AsyncBot\Core;

use Amp\Promise;

interface Driver
{
    /**
     * @return Promise<null>
     */
    public function start(): Promise;

    /**
     * @return Promise<null>
     */
    public function postMessage(string $message): Promise;
}
