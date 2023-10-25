<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    

    
    protected $guarded = ['id'];
    public function merk(){
        return $this->belongsTo(MerkBarang::class,'merk_id');
    }
    public function tipe(){
        return $this->belongsTo(TipeBarang::class,'tipe_id');
    }
    public function jenis(){
        return $this->belongsTo(JenisBarang::class,'jenis_id');
    }

}
