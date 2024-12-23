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
        Schema::create('chitietnhom', function (Blueprint $table) {
            $table->foreignId('id_nhom')->constrained('nhom')->onDelete('CASCADE');
            $table->foreignId('id_user')->constrained('users')->onDelete('CASCADE');
            $table->primary(['id_nhom', 'id_user']);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietnhoms');
    }
};
