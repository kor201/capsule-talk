<?php

namespace App\Services\Api;

use App\Repositories\Message\MessageInterface;

class MessageService
{
    protected $messageImpl;

    public function __construct(MessageInterface $messageImpl)
    {
        $this->messageImpl = $messageImpl;
    }

    public function createPostMessage(array $input): bool
    {
        return $this->messageImpl->save($input);
    }
}
