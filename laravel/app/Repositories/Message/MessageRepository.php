<?php

namespace App\Repositories\Message;

use App\Models\Entities\Message;

class MessageRepository implements MessageInterface
{
    protected $model;

    public function __construct(Message $model)
    {
        $this->model = $model;
    }

    public function find($id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function save(array $attributes)
    {
        $newMessage = $this->model->newInstance();
        $newMessage->fill($attributes);
        return $newMessage->save();
    }
}
