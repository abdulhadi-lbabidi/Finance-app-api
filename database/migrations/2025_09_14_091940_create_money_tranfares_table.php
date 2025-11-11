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
        Schema::create('money_tranfares', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->integer('amount');
            $table->foreignId('from_tresure_fund_id')->references('id')->on('tresure_funds')->onDelete('cascade');
            $table->foreignId('to_tresure_fund_id')->references('id')->on('tresure_funds')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money_tranfares');
    }
};
