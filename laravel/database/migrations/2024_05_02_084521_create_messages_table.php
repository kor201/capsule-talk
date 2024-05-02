<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id()->comment('主キー');
            $table->foreignId('room_id')->constrained()->onDelete('cascade')->comment('ルームテーブルへの外部キー。メッセージが属するルームを示す');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('ユーザーテーブルへの外部キー。メッセージの送信者を示す');
            $table->text('message')->comment('メッセージ');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
