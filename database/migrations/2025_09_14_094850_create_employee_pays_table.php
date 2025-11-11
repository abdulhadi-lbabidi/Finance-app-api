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
        Schema::create('employee_pays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desc')->nullable();
            $table->integer('amount');
            $table->integer('price');
            $table->integer('finalprice')->nullable();
            $table->boolean('payed');
            $table->foreignId('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreignId('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_pays');
    }
};
