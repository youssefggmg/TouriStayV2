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
        Schema::create("announcment",function(Blueprint $table){
            $table->id();
            $table->string("title");
            $table->string("city");
            $table->decimal("price")->default(00.00);
            $table->date("disponibility");
            $table->integer("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("announcment");
    }
};
