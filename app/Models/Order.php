<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function barang(){
        return $this->belongsTo(Barang::class,'barang_id');
    } 
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }  
    public function ruangan(){
        return $this->belongsTo(Ruangan::class,'ruangan_id');
    }

}
