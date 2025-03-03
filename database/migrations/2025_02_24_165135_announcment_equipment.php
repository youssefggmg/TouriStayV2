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
        Schema::create('announcment_equipment', function (Blueprint $table) {
            $table->id();
            $table->integer("annoucment_id");
            $table->integer("equipment_id");
            $table->foreign("annoucment_id")->references("id")->on("announcment");
            $table->foreign("equipment_id")->references("id")->on("equipment");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcment_equipment');
    }
};
