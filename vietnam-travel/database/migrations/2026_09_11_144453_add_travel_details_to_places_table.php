<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('places', function (Blueprint $table) {

            $table->string('best_months', 100)
                ->nullable()
                ->after('best_time');

            $table->text('notes')
                ->nullable()
                ->after('best_months');

            $table->text('activities')
                ->nullable()
                ->after('notes');

        });
    }

    public function down(): void
    {
        Schema::table('places', function (Blueprint $table) {

            $table->dropColumn([
                'best_months',
                'notes',
                'activities',
            ]);

        });
    }
};