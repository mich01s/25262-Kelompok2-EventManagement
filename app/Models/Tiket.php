<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $primaryKey = 'tiket_id';
    protected $fillable = [
        'event_id',
        'nama_tiket',
        'harga',
        'jumlah_tiket'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'tiket_id', 'tiket_id');
    }
}
