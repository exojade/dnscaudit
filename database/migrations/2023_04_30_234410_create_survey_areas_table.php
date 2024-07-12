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
        Schema::create('survey_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->nullable()->constrained();
            $table->foreignId('area_id')->nullable()->constrained();
            $table->integer('promptness')->nullable();
            $table->integer('engagement')->nullable();
            $table->integer('cordiality')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_offices');
    }
};
