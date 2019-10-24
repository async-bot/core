<?php declare(strict_types=1);

namespace AsyncBot\Core\Exception\Storage;

use AsyncBot\Core\Exception\Exception;

final class EntryNotFound extends Exception
{
    public function __construct(string $key)
    {
        parent::__construct(
            sprintf('No entry exists for key %s in the storage', $key),
        );
    }
}
