<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'is_private', 'max_participants'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'room_user')->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
