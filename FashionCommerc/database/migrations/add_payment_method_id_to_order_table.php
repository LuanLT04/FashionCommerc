<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_method_id')->nullable()->after('address');
        });
    }
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('payment_method_id');
        });
    }
}; 