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
        Schema::create('audit_plan_batches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->constrained();
            $table->foreignId('audit_plan_id')->nullable()->constrained();
            $table->date('date_scheduled');
            $table->time('from_time');
            $table->time('to_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_plan_batches');
    }
};