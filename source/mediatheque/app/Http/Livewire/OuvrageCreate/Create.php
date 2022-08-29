<?php

namespace App\Http\Livewire\OuvrageCreate;

use App\Models\Ouvrage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    public $niveaus;
    public $types;
    public $langues;
    public $titre;
    public $selected_annee;

    public function validateOuvrage(){
        $ouvrages = Ouvrage::all()->where("titre", $this->titre);
        foreach ($ouvrages as $ouvrage){
            $annee = $ouvrage->auteurs()->first()->pivot->annee_apparution;
            if($annee==$this->selected_annee){
                $this->alert('error', 'Cet ouvrage existe déjà', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.ouvrage-create.create');
    }
}
