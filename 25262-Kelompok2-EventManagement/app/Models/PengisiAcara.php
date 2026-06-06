<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengisiAcara extends Model
{
    protected $primaryKey = 'pengisi_acara_id';
    protected $fillable = [
        'nama_pengisi_acara',
    ];
    protected $table = 'pengisi_acaras';
    public $timestamps = true;

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
