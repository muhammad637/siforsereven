<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'nama' => 'admin', 
            // 'email' => 'admin@argon.com',
            'password' => bcrypt('secret'),
            'no_telephone' => '085156327536',
            // 'alamat' => 'jl cokroaminoto'
        ]);

        DB::table('merk_barangs')->insert([
            'merk' => 'samsung'
        ]);
        // DB::table('jenis_barangs')->insert([
        //     'merk' => ''
        // ]);
        // factory(Outlate::class,10)->create();
    }
}
