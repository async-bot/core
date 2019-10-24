<?php declare(strict_types=1);

namespace AsyncBot\Core\Storage\KeyValue;

use Amp\Promise;
use Amp\Success;
use AsyncBot\Core\Exception\Storage\EntryNotFound;
use AsyncBot\Core\Storage\KeyValue;
use function Amp\call;
use function Amp\File\get;
use function Amp\File\put;
use function ExceptionalJSON\decode;
use function ExceptionalJSON\encode;

final class FileSystem implements KeyValue
{
    private string $filename;

    private ?array $data = null;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * @param mixed $value
     * @return Promise<null>
     */
    public function set(string $key, $value): Promise
    {
        return call(function () use ($key, $value) {
            yield $this->loadDataWhenNeeded();

            $this->data[$key] = $value;

            yield $this->saveData();
        });
    }

    /**
     * @return Promise<mixed>
     */
    public function get(string $key): Promise
    {
        return call(function () use ($key) {
            yield $this->loadDataWhenNeeded();

            if (!array_key_exists($key, $this->data)) {
                throw new EntryNotFound($key);
            }

            return $this->data[$key];
        });
    }

    /**
     * @return Promise<null>
     */
    public function unset(string $key): Promise
    {
        return call(function () use ($key) {
            yield $this->loadDataWhenNeeded();

            unset($this->data[$key]);

            yield $this->saveData();
        });
    }

    /**
     * @return Promise<null>
     */
    public function clear(): Promise
    {
        return call(function () {
            $this->data = [];
            yield $this->saveData();
        });
    }

    /**
     * @return Promise<null>
     */
    private function loadDataWhenNeeded(): Promise
    {
        if ($this->data !== null) {
            return new Success();
        }

        return call(function () {
            $this->data = decode(yield get($this->filename), true);
        });
    }

    /**
     * @return Promise<null>
     */
    private function saveData(): Promise
    {
        return call(function () {
            yield put($this->filename, encode($this->data));
        });
    }
}
