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
        Schema::create("reservation",function(Blueprint $table){
            $table->id();
            $table->date("startDate");
            $table->date("endDate");
            $table->float("totale");
            $table->foreignId("announce_id")->constrained("announcment")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("reservation");
    }
};
