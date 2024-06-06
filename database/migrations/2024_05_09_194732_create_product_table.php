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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->bigInteger('stock');
            $table->bigInteger('unit_price');
            $table->string('category');
            $table->date('due_date')->nullable();
            $table->date('updated_at');
            $table->date('created_at');
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->string('registerby')->nullable();
            $table->foreignId('id_supplier')
                  ->constrained('suppliers')
                  ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
