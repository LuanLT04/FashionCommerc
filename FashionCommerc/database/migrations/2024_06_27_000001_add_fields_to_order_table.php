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
        Schema::table('order', function (Blueprint $table) {
            $table->string('status', 30)->default('pending')->after('address'); // Trạng thái đơn hàng
            $table->string('payment_status', 30)->default('unpaid')->after('status'); // Trạng thái thanh toán
            $table->string('payment_method', 50)->nullable()->after('payment_status'); // Phương thức thanh toán
            $table->double('shipping_fee')->default(0)->after('total_order'); // Phí ship
            $table->double('discount')->default(0)->after('shipping_fee'); // Chiết khấu
            $table->string('phone', 20)->nullable()->after('payment_method'); // Số điện thoại
            $table->string('note', 255)->nullable()->after('phone'); // Ghi chú
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn(['status', 'payment_status', 'payment_method', 'shipping_fee', 'discount', 'phone', 'note']);
        });
    }
}; 