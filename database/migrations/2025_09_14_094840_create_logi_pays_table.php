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
        Schema::create('logi_pays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desc')->nullable();
            $table->integer('amount');
            $table->integer('price');
            $table->string('workshopname')->nullable();
            $table->boolean('payed');
            $table->foreignId('logistic_team_id')
                ->references('id')
                ->on('logistic_teams')
                ->onDelete('cascade');
            $table->foreignId('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('cascade');
            $table->decimal('discount_value', 10, 2)
                ->default(0);
            $table->enum('discount_type', ['قيمة', 'نسبة'])
                ->default('قيمة');
            $table->decimal('finalprice', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logi_pays');
    }
};
