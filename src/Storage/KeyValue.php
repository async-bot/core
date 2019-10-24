<?php declare(strict_types=1);

namespace AsyncBot\Core\Storage;

use Amp\Promise;

interface KeyValue
{
    /**
     * @param mixed $value
     * @return Promise<null>
     */
    public function set(string $key, $value): Promise;

    /**
     * @return Promise<mixed>
     */
    public function get(string $key): Promise;

    /**
     * @return Promise<null>
     */
    public function unset(string $key): Promise;

    /**
     * @return Promise<null>
     */
    public function clear(): Promise;
}
