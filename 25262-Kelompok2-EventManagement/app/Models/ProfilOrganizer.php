<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilOrganizer extends Model
{
    protected $primaryKey = 'organizer_id';
    protected $fillable = ['user_id', 'nama_organizer'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id', 'organizer_id');
    }
}
