<?php declare(strict_types=1);

namespace AsyncBot\Core\Message\Node;

final class Message extends Container
{
    public function setReplyAttribute(string $type, string $replyTo): void
    {
        $this->addAttribute('type', $type);
        $this->addAttribute('replyTo', $replyTo);
    }

    public function getName(): string
    {
        return 'message';
    }
}
