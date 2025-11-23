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
    Schema::create('tech_pays', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('desc')->nullable();
      $table->decimal('amount', 15, 2)->default(0);
      $table->decimal('price', 15, 2)->default(0);
      $table->string('workshopname')->nullable();
      $table->boolean('payed');
      $table->foreignId('technical_team_id')
        ->references('id')
        ->on('technical_teams')
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
    Schema::dropIfExists('tech_pays');
  }
};
