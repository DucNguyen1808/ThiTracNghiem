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
        Schema::create('dapan', function (Blueprint $table) {
            $table->id();
            $table->string('noidung');
            $table->boolean('is_dapan');
            $table->foreignId('id_cauhoi')->constrained('cauhoi')->onDelete('CASCADE');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dap_ans');
    }
};
