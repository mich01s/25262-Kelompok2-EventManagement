<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriEvent;
use App\Models\PengisiAcara;
use App\Models\ProfilOrganizer;
use App\Models\Tiket;

class Event extends Model
{
    protected $primaryKey = 'event_id';
    protected $fillable = [
        'organizer_id',
        'kategori_id',
        'nama_event',
        'tanggal_mulai',
        'lokasi',
        'google_maps',
        'foto'
    ];

    public function organizer()
    {
        return $this->belongsTo(ProfilOrganizer::class, 'organizer_id', 'organizer_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriEvent::class, 'kategori_id', 'kategori_id');
    }

    public function pengisis()
    {
        return $this->belongsToMany(PengisiAcara::class, 'event_pengisi_acaras', 'event_id', 'pengisi_acara_id');
    }

    public function tikets()
    {
        return $this->hasMany(Tiket::class, 'event_id', 'event_id');
    }

    // Convenience one-to-one relation for views that expect a single ticket
    public function tiket()
    {
        return $this->hasOne(Tiket::class, 'event_id', 'event_id');
    }
}