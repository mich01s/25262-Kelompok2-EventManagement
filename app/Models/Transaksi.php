<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = 'transaksi_id';
    protected $fillable = [
        'user_id',
        'total_tagihan',
        'total_id',
        'total_pembayaran',
        'bukti_pembayaran',
        'metode_pembayaran',
        'status_pembayaran'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id', 'transaksi_id');
    }
}
