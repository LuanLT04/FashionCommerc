<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id('id_product');
            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_manufacturer');
            $table->string('name_product');
            $table->string('quantity_product');
            $table->string('price_product');
            $table->string('image_address_product');
            $table->text('describe_product');
            $table->string('specifications');

            $table->string('sizes')->nullable(); // Thêm cột sizes
            $table->string('colors')->nullable(); // Thêm cột colors
            $table->integer('purchased')->default(0);
            $table->timestamps();

            $table->foreign('id_category')->references('id_category')->on('categories')->onDelete('cascade');
            $table->foreign('id_manufacturer')->references('id_manufacturer')->on('manufacturers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
