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
        Schema::create('spare_part_repairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spare_part_id')->constrained('spare_parts');
            $table->foreignId('repair_id')->constrained('repairs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spare_part_repairs');
    }
};
