<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('detailsorder', function (Blueprint $table) {
            $table->string('product_name')->after('quantity_detailsorder');
            $table->string('image')->after('product_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detailsorder', function (Blueprint $table) {
            $table->dropColumn(['product_name', 'image']);
        });
    }
}; 