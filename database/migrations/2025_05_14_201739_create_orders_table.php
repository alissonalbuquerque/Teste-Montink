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
        Schema::create('orders', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('cupom_id')->nullable()->constrained('coupons');
            $table->string('email');
            $table->decimal('cupom');
            $table->decimal('frete');
            $table->decimal('subtotal');
            $table->decimal('buy');
            $table->string('status')->default('pending');
            $table->string('payment_method')->default('card');
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
