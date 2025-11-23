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
    Schema::create('inner_transactions', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->text('desc')->nullable();
      $table->boolean('payed');
      $table->decimal('amount', 15, 2)->default(0);
      $table->date('indate');
      $table->foreignId('tresure_fund_id')->references('id')->on('tresure_funds')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('inner_transactions');
  }
};
