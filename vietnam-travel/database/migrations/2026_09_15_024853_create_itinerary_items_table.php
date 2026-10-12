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
        Schema::create('itinerary_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('itinerary_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('place_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('day_number');

            $table->time('start_time')->nullable();

            $table->time('end_time')->nullable();

            $table->unsignedSmallInteger('sort_order')
                ->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerary_items');
    }
};
