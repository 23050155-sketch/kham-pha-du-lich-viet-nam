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
        Schema::create('places', function (Blueprint $table) {
            $table->id();

            $table->foreignId('province_id')
                ->constrained('provinces')
                ->restrictOnDelete();

            $table->string('name', 180);

            $table->string('slug', 220)->unique();

            $table->string('short_description', 500)->nullable();

            $table->text('description')->nullable();

            $table->string('address', 500)->nullable();

            $table->decimal('ticket_price', 12, 2)->default(0);

            $table->time('open_time')->nullable();

            $table->time('close_time')->nullable();

            $table->unsignedSmallInteger('visit_duration_min')->default(120);

            $table->enum('best_time', [
                'morning',
                'afternoon',
                'evening',
                'any'
            ])->default('any');

            $table->decimal('latitude', 10, 7)->nullable();

            $table->decimal('longitude', 10, 7)->nullable();

            $table->unsignedInteger('view_count')->default(0);

            $table->boolean('is_featured')->default(false);

            $table->enum('status', ['active', 'hidden'])
                ->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
