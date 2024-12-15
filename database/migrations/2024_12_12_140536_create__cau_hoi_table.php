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
        Schema::create('cauhoi', function (Blueprint $table) {
            $table->id();
            $table->string('noidung');
            $table->integer('dokho');
            $table->foreignId('id_monhoc')
                ->nullable()
                ->constrained('monhoc')
                ->onDelete('set null');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_cau_hoi');
    }
};
