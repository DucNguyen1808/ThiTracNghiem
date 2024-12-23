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
        Schema::create('chitietdethi', function (Blueprint $table) {
            $table->foreignId('id_cauhoi')->constrained('cauhoi')->onDelete('CASCADE');
            $table->foreignId('id_de')->constrained('dethi')->onDelete('CASCADE');
            $table->primary(['id_cauhoi', 'id_de']);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietdethi');
    }
};
