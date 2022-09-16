<?php

namespace App\Http\Livewire\Approvisionnements;

use App\Models\DocumentsAudioVisuel;
use App\Models\LivresPapier;
use App\Models\Personnel;
use App\Models\User;
use App\Service\ApprovisionnementService;
use App\Service\PersonnelService;
use Livewire\Component;

class EditeApprovisionementsLivewire extends Component
{
    public $personnels;
    public $approvisionnement;
    public $nom_personne ;
    public $titre;
    public $ouvrage_code_id;
    public $date;
    public $type_ouvrage;
    public $id_ouvrage;


    public function searchOuvragePysique()
    {
        if($this->type_ouvrage != null){
            if($this->type_ouvrage != null){
                $o = ApprovisionnementService::getOuvrage($this->type_ouvrage, $this->ouvrage_code_id);
                if($o!=null){
                    $this->titre = $o->ouvrage_physique->ouvrage->titre;
                    $this->id_ouvrage = $o->ouvrage_physique->ouvrage->id_ouvrage;
                } else{
                    $this->titre="L'isbn n'existe pas.";
                }
            } else {
                $this->titre="Veillez choisire le type";
            }
        }
    }

    public function render()
    {
        return view('livewire.approvisionnements.edite-approvisionement-livewire')
            ->with([
                'prenoms_personnes'=> Personnel::all()->whereIn('id_personnel', PersonnelService::getIDPersonnelByUserName($this->nom_personne)),
                'date_approvisionnement'=>date('Y-m-d'),
                'approvisionnements'=>$this->approvisionnement
            ]);
    }
}
