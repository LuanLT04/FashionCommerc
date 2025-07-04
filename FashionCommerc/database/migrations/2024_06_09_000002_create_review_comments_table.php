<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('review_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('review_id');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('content');
            $table->json('images')->nullable();
            $table->timestamps();

            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('review_comments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('review_comments');
    }
}; 