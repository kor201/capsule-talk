<?php

namespace App\Repositories\Message;

use App\Models\Entities\Message;
use Illuminate\Database\Eloquent\Builder;

class MessageRepository implements MessageInterface
{
    protected $model;

    public function __construct(Message $model)
    {
        $this->model = $model;
    }
}
