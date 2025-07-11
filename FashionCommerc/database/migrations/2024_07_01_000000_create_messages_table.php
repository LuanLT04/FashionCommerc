<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->text('content');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            $table->foreign('sender_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('messages');
    }
}; 