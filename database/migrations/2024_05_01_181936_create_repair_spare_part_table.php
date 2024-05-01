<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairSparePartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_spare_part', function (Blueprint $table) {
            $table->foreignId('repair_id')->constrained('repairs') ;//->onDelete('cascade');
            $table->foreignId('spare_part_id')->constrained('spare_parts') ;//->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_spare_part');
    }
}

