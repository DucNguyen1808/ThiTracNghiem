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
        Schema::create('ketqua', function (Blueprint $table) {
            $table->foreignId('id_dethi')->constrained('dethi')->onDelete('CASCADE');
            $table->foreignId('id_user')->constrained('users')->onDelete('CASCADE');
            $table->primary(['id_user', 'id_dethi']);
            $table->double('diem')->default(0);
            $table->datetime('tgvaothi')->nullable();
            $table->integer('tglambai')->nullable();
            $table->integer('socaudung')->nullable();
            $table->boolean('trangthailambai')->default(false);
            $table->boolean('danop')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ket_quas');
    }
};
