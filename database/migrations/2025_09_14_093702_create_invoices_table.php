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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('text');
            $table->text('desc')->nullable();
            $table->integer('amount');
            $table->foreignId('finance_item_id')
                ->references('id')
                ->on('finance_items')
                ->onDelete('cascade');
            $table->morphs('invoiceable');
            $table->decimal('discount_value', 10, 2)
                ->default(0);
            $table->enum('discount_type', ['قيمة', 'نسبة'])
                ->default('قيمة');
            $table->decimal('final_price', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
