<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','anggota_id','book_id','tanggal_peminjaman','tanggal_pengembalian','status'
    ];

    public function anggota ()
    {
        return $this->belongsTo(Anggota::class,'anggota_id');
    }

    public function book ()
    {
        return $this->belongsTo(Book::class,'book_id');
    }
}
