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
        Schema::create('giaodethi', function (Blueprint $table) {
            $table->foreignId('id_nhom')->constrained('nhom')->onDelete('CASCADE');
            $table->foreignId('id_dethi')->constrained('dethi')->onDelete('CASCADE');
            $table->primary(['id_dethi', 'id_nhom']);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giao_de_this');
    }
};
