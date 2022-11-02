<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    use HasFactory;
    protected $fillable = ['date_emprunt', 'date_retour','id_abonne', 'id_personnel'];
    protected $primaryKey = 'id_emprunt';
    protected $dates = ['date_emprunt', 'date_retour'];

    public function getNombreOuvrageEmprunteAttribute()
    {
        return $this->lignesEmprunts()->count();
    }

    public  function  empruntExpierAttribute(){
        return Carbon::now()->gt($this->date_retour);
    }
    public function getJourRestantAttribute(){
        $nbJour = -1;
        if (! $this->empruntExpierAttribute()){
            $nbJour = $this->date_retour->diffInDays($this->date_emprunt);
        } else {
            $nbJour = Carbon::now()->diffInDays($this->date_retour)*-1;
        }

        return $nbJour;
    }

    public function abonne()
    {
        return $this->belongsTo('App\Models\Abonne', 'id_abonne');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'id_personnel');
    }

    public function lignesEmprunts()
    {
        return $this->hasMany(LignesEmprunt::class, 'id_emprunt');
    }

    public function restitution()
    {
        return $this->hasOne(Restitution::class, 'id_restitution');
    }
}
