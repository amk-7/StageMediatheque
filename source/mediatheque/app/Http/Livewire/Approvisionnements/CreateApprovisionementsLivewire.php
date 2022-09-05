<?php

namespace App\Http\Livewire\Approvisionnements;

use App\Models\DocumentsAudioVisuel;
use App\Models\LivresPapier;
use App\Models\Ouvrage;
use App\Models\Personnel;
use App\Models\User;
use App\Service\ApprovisionnementService;
use App\Service\OuvragesPhysiqueService;
use App\Service\PersonnelService;
use App\Service\UserService;
use Livewire\Component;

class CreateApprovisionementsLivewire extends Component
{

    public $personnels;
    public $nom_personne;
    public $titre;
    public $ouvrage_code_id;
    public $date;
    public $type_ouvrage;

    public $lignes = array();
    public $numero = 1;
    public $nombre_exemplaire;
    public $data = "";
    public $value;

    public $titre_ouvrage_erreur = false;
    public $type_ouvrage_erreur = false;
    public $nombre_exemplaire_erreur = false;
    public $ouvrage_not_found_erreur = false;

    public function setTitre()
    {
        dd($this->value);
    }

    public function searchTitreByIdentifiant()
    {
        if(empty($this->titre)){
            $id_ouvrage = OuvragesPhysiqueService::getIDouvrage($this->type_ouvrage, $this->ouvrage_code_id, "");
            //dd($id_ouvrage);
            if ($id_ouvrage != null){
                $this->titre = Ouvrage::all()->where('id_ouvrage', $id_ouvrage)->first()->titre;
            }
        }
        //return $this->titre;
    }

    public function addLigne()
    {
        if(empty($this->type_ouvrage)){
            $this->type_ouvrage_erreur = true;
            return;
        }
        $this->type_ouvrage_erreur = false;

        if (empty($this->titre)){
            $this->titre_ouvrage_erreur = true;
            return;
        }
        $this->titre_ouvrage_erreur = false;

        if (empty($this->nombre_exemplaire)){
            $this->nombre_exemplaire_erreur = true;
            return;
        }
        $this->nombre_exemplaire_erreur = false;
        $id_ouvrage = OuvragesPhysiqueService::getIDouvrage($this->type_ouvrage, $this->ouvrage_code_id, $this->titre);
        //dd($id_ouvrage);
        if ($id_ouvrage==null){
            $this->ouvrage_not_found_erreur = true;
            return ;
        }

        if (empty($this->titre)){
            $this->titre = Ouvrage::all()->where('id_ouvrage', $id_ouvrage)->first()->titre;
        }

        $ligne = array(
            'numero_ligne'=>$this->numero,
            'ouvrage'=>$this->titre,
            'type'=>$this->type_ouvrage,
            'nombre_exemplaire'=>$this->nombre_exemplaire,
        );
        array_push($this->lignes, $ligne);
        $this->numero++;
        //dd($this->lignes[0]['numero_ligne']);
        $this->data .= $id_ouvrage.",".$this->type_ouvrage.",".$this->nombre_exemplaire.";";

        $this->ouvrage_code_id = "";
        $this->type_ouvrage = "";
        $this->titre = "";
        $this->nombre_exemplaire = "";
    }

    public function render()
    {
        return view('livewire.approvisionnements.create-approvisionements-livewire')
            ->with([
                'prenoms_personnes'=> Personnel::all()->whereIn('id_personnel', PersonnelService::getIDPersonnelByUserName($this->nom_personne)),
                'date_approvisionnement'=>date('Y-m-d'),
                'ouvragesPhysique'=>OuvragesPhysiqueService::searchOuvrageByTitre(""),
            ]);
    }
}
