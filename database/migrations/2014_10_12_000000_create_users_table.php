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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username');
            $table->string('nik')->unique()->nullable(); 
            $table->string('no_telephone')->nullable();
            $table->string('password');
            // $table->string('alamat')->nullable();
            $table->enum('cekLevel',['admin','teknisi'])->default('admin');
            $table->enum('status',['aktif','nonaktif'])->default('aktif');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('outlet_id')->nullable();
            $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
