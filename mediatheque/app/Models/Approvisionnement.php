<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class Approvisionnement extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_exemplaire', 'id_ouvrage', 'type_ouvrage', 'id_personnel', 'date_approvisionnement'];
    protected $primaryKey = 'id_approvisionnement';
    protected $dates = ['date_approvisionnement'];


    public function ouvrage()
    {
        return $this->belongsTo(Ouvrage::class, 'id_ouvrage');
    }
    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'id_personnel');
    }
}
