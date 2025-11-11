<?php

use App\Models\LogisticTeam;
use App\Models\Workshop;
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
        Schema::create('logistic_workshops', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LogisticTeam::class);
            $table->foreignIdFor(Workshop::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistic_workshops');
    }
};
