<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','loans_id','tanggal_pengembalian'
    ];

    public function loans()
    {
        return $this->belongsTo(loans::class,'loans_id');
    }

    protected static function boot()
{ // agar barang yang sudah di kembalikan oomatis berubah di peminjaman
    parent::boot();

    static::created(function ($return) {
        // Cari peminjaman berdasarkan loans_id yang dikembalikan
        $loans = \App\Models\loans::find($return->loans_id);

        if ($loans) {
            $loans->status = 'dikembalikan'; // Ubah status menjadi dikembalikan
            $loans->save();
        }
    });
}
}
