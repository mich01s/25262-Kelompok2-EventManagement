<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'event_id';
    protected $fillable = [
        'organizer_id',
        'kategori_id',
        'nama_event',
        'tanggal_mulai',
        'lokasi',
        'google_maps'
    ];

    public function organizer()
    {
        return $this->belongsTo(ProfilOrganizer::class, 'organizer_id', 'organizer_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriEvent::class, 'kategori_id', 'kategori_id');
    }
}
