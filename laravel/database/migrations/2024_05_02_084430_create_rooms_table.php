<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id()->comment('主キー');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('ユーザーテーブルへの外部キー');
            $table->string('name')->comment('ルーム名');
            $table->boolean('is_private')->default(false)->comment('ルームが公開or非公開。非公開の場合はtrue');
            $table->integer('max_participants')->default(5)->comment('最大参加者数');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
