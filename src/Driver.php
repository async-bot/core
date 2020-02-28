<?php declare(strict_types=1);

namespace AsyncBot\Core;

use Amp\Promise;
use AsyncBot\Core\Message\Node\Message;

interface Driver
{
    /**
     * @return Promise<null>
     */
    public function start(): Promise;

    /**
     * @return Promise<null>
     */
    public function postMessage(Message $message): Promise;
}
