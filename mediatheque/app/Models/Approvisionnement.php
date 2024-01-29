<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class Approvisionnement extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_exemplaire', 'id_ouvrage', 'type_ouvrage', 'id_personnel', 'date_approvisonnement'];
    protected $primaryKey = 'id_approvisionnement';
    protected $dates = ['date_approvisonnement'];

    public static function enregistrerPlusieursApprosionnement($data)
    {
        $data = Controller::extractLineToData($data);
        for ($i = 0; $i < count($data) - 1; $i++) {
            $id_personnel = Personnel::all()->where('id_utilisateur', Auth::user()->id_utilisateur)->first()->id_personnel;
            self::enregistrerUnApprovisionnement($data[$i][0], $data[$i][1], $id_personnel);
        }
    }

    public static function enregistrerUnApprovisionnement($id_ouvrage, $nombre_exemplaire, $id_personnel)
    {
        $ouvrage = Ouvrage::find($id_ouvrage);
        $ouvrage->augmenterNombreExemplaire($nombre_exemplaire);
        $ouvrage->save();
        Approvisionnement::create([
            'nombre_exemplaire' => $nombre_exemplaire,
            'date_approvisionnement' => date('d-m-Y'),
            'id_personnel' => $id_personnel,
            'id_ouvrage' => $ouvrage->id_ouvrage,
        ]);
    }

    public function ouvrage()
    {
        return $this->belongsTo(Ouvrage::class, 'id_ouvrage');
    }
    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'id_personnel');
    }
}
