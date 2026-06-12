<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengisiAcara extends Model
{
    protected $primaryKey = 'pengisi_acara_id';
    protected $fillable = [
        'organizer_id',
        'nama_pengisi_acara',
    ];
    protected $table = 'pengisi_acaras';
    public $timestamps = true;

    public function organizer()
    {
        return $this->belongsTo(ProfilOrganizer::class, 'organizer_id', 'organizer_id');
    }

    /**
     * Relasi dengan EventPengisiAcara
     */
    public function eventPengisiAcara()
    {
        return $this->hasMany(EventPengisiAcara::class, 'pengisi_acara_id');
    }

    /**
     * Relasi dengan Event melalui EventPengisiAcara
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_pengisi_acaras', 'pengisi_acara_id', 'event_id');
    }
}
