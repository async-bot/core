<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Exception;

final class MissingRootNode extends InvalidMessage
{
    public function __construct()
    {
        parent::__construct('Expected root <message> node');
    }
}
