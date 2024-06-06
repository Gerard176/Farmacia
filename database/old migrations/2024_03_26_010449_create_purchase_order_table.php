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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->date('delivery_date')->nullable();
            $table->string('order_state');
            $table->bigInteger('order_price');
            $table->foreignId('id_user')
                  ->constrained('users');
            $table->string('factura')->nullable();
            $table->string('status')->nullable();
            $table->string('registerby')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order');
    }
};
