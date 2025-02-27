<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    /** @use HasFactory<\Database\Factories\AnggotaFactory> */
    use HasFactory;

    protected $fillable = [
        'id','nama','email','alamat','telepon'
    ];

    
    // public function loans ()
    // {
    //     return $this->hasMany(loans::class,'loans_id');
    // }
}
