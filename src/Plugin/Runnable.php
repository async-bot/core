<?php declare(strict_types=1);

namespace AsyncBot\Core\Plugin;

use Amp\Promise;

interface Runnable
{
    /**
     * @return Promise<null>
     */
    public function run(): Promise;
}
