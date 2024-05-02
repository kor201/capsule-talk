<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('room_user', function (Blueprint $table) {
            $table->id()->comment('主キー');
            $table->foreignId('room_id')->constrained()->comment('roomsテーブルへの外部キー');
            $table->foreignId('user_id')->nullable()->constrained()->comment('usersテーブルへの外部キー');
            $table->timestamp('joined_at')->default(now())->comment('参加日時');
            $table->timestamp('left_at')->nullable()->comment('退室日時');
        });
    }

    public function down()
    {
        Schema::dropIfExists('room_user');
    }
};
