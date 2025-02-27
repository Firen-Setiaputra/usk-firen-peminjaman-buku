<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'id','kode_buku','nama_buku','penulis', 'penerbit','kategori','stock','deskripsi','status'
    ];

    
    public function loans ()
    {
        return $this->hasMany(loans::class,'loans_id');
    }
}
