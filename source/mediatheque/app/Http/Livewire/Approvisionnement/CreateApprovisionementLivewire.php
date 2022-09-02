<?php

namespace App\Http\Livewire\Approvisionnement;

use App\Models\DocumentsAudioVisuel;
use App\Models\LivresPapier;
use App\Models\Personnel;
use App\Models\User;
use Livewire\Component;

class CreateApprovisionementLivewire extends Component
{
    public $personnels;
    public $nom_personne;
    public $titre;
    public $ouvrage_code_id;
    public $date;
    public $type_ouvrage;
    public $id_ouvrage;

    public function searchOuvragePysique()
    {
        if($this->type_ouvrage != null){
            if($this->type_ouvrage=="livre_papier"){
                $ouvrage=LivresPapier::all()->where('ISBN', $this->ouvrage_code_id)
                                                ->first()
                                                ->ouvragePhysique
                                                ->ouvrage;
            } else if ($this->type_ouvrage=="document_audio_visuel"){
                $ouvrage=DocumentsAudioVisuel::all()->where('ISAN', $this->ouvrage_code_id)
                                                        ->first()
                                                        ->ouvragePhysique
                                                        ->ouvrage->titre;
            }
            $this->titre = $ouvrage->titre;
            $this->id_ouvrage = $ouvrage->id_ouvrage;
        }
    }

    public function render()
    {
        return view('livewire.approvisionnement.create-approvisionement-livewire')
            ->with([
                'prenoms_personnes'=> User::all()->where('nom', $this->nom_personne),
                'date_approvisionnement'=>date('Y-m-d')
            ]);
            /*->with([
                'prenoms_personnes'=>Personnel::all()->whereIn(
                    'id_utilisateur',
                    User::all('id_utilisateur')->where('nom', $this->nom_personne)
                )
            ]);*/
    }
}
