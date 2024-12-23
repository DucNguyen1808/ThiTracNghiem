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
        Schema::create('dethi', function (Blueprint $table) {
            $table->id();
            $table->string('tende');
            $table->integer('tgthi');
            $table->dateTime('tgmode');
            $table->dateTime('tgketthuc');
            $table->boolean('troncauhoi');
            $table->boolean('trondapan');
            $table->boolean('xemdiemthi');
            $table->foreignId('id_monhoc')->constrained('monhoc')->onDelete('CASCADE');
            $table->integer('socaude');
            $table->integer('socautrungbinh');
            $table->integer('socaukho');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('de_this');
    }
};
