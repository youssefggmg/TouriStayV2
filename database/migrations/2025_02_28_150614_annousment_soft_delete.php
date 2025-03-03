<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('announcment', function (Blueprint $table) {
            $table->softDeletes(); // Adds 'deleted_at' column
        });
    }

    public function down(): void {
        Schema::table('announcment', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};