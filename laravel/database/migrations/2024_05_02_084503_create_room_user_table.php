<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('room_user', function (Blueprint $table) {
            $table->foreignId('room_id')->constrained()->onDelete('cascade')->comment('roomsテーブルへの外部キー');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('usersテーブルへの外部キー');
            $table->timestamp('joined_at')->default(now())->comment('参加日時');
            $table->timestamp('left_at')->nullable()->comment('退室日時');
            $table->primary(['room_id', 'user_id'])->comment('room_idとuser_idの複合主キー');
        });
    }

    public function down()
    {
        Schema::dropIfExists('room_user');
    }
};
