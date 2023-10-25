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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barangs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('ruangan_id')->constrained('ruangans')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_pelapor');
            $table->string('no_pelapor');
            $table->date('tanggal_order');
            $table->text('pesan_kerusakan');
            $table->string('status')->nullable();
            $table->string('status_selesai')->nullable();
            $table->text('pesan_status')->nullable();
            $table->date('tanggal_selesai')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
