<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_id')->constrained('jenis_barangs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('merk_id')->constrained('merk_barangs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tipe_id')->constrained('tipe_barangs')->onUpdate('cascade')->onDelete('cascade');
            // $table->string('tipe');
            // $table->string('jenis');
            $table->enum('status',['aktif','nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
