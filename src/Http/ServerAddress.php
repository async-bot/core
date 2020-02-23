<?php declare(strict_types=1);

namespace AsyncBot\Core\Http;

final class ServerAddress
{
    private string $address;

    private int $port;

    public function __construct(string $address, int $port)
    {
        $this->address = $address;
        $this->port    = $port;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function toString(): string
    {
        return sprintf('%s:%d', $this->address, $this->port);
    }
}
