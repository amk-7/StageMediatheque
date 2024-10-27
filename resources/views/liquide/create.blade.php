@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-center items-center m-auto">
    <form action="{{route('storeLiquide')}}" method="post" class="bg-white p-12 mb-12 space-y-3">
        @csrf
        <h1 class="label_title">Registrations</h1>
       <fieldset class="fieldset_border">
           <legend>Abonne</legend>
           <div>
               <label class="label">Nom</label>
               <select name="nom_abonnes" id="nom_abonnes" class="select_btn">
               </select>
           </div>
           <div>
               <label class="label">Prénom</label>
               <select name="prenom_abonnes" id="prenom_abonnes" class="select_btn">
                   <option>Séléctionner prénom</option>
               </select>
           </div>
       </fieldset>
        <fieldset>
            <legend>Abonnement</legend>
            <div>
                <label class="label">
                    <span>Montant: </span>
                    <span id="montant">0 FCFA</span>
                </label>
            </div>
            <input type="text" name="tarifs" value="" id="tarifs" hidden>
        </fieldset>
        <input type="submit" value="Enregistré" class="button button_primary">
    </form>
</div>
@endsection
@section("js")
    <script type="text/javascript" async>

        let abonnes = {!! $abonnes !!};
        let tarifs = {!! $tarifs !!};

        let nom_abonnes = document.getElementById('nom_abonnes');
        let prenom_abonnes = document.getElementById('prenom_abonnes');
        let balise_tarifs = document.getElementById('tarifs');
        let montant = document.getElementById('montant');

        let submit_btn = document.getElementById('action_registrer');
        setLiteOptions(nom_abonnes, abonnes, "nom", 'nom');

        nom_abonnes.addEventListener('change', function (e) {
            mettreListePrenomParNom(prenom_abonnes, nom_abonnes.value, abonnes, "prenom");
        });
        prenom_abonnes.addEventListener('change', function(e){
            for (let i = 0; i < abonnes.length; i++) {
                if (abonnes[i]['id'] == this.value){
                    let _tarif = "200";
                    if (abonnes[i]['niveau'] == "0"){
                        _tarif = "500";
                    }
                    balise_tarifs.value = _tarif;
                    montant.innerText = _tarif+" FCFA";
                }
            }
        });

        function mettreListePrenomParNom(balise, elt, liste, colonne) {
            while (balise.firstChild) {
                balise.removeChild(balise.firstChild);
            }
            let option = document.createElement('option');
            option.innerText = `Séléctionner ${colonne}`;
            balise.appendChild(option);
            for (let i = 0; i < liste.length; i++) {
                if (elt === liste[i]['nom']) {
                    let option = document.createElement('option');
                    option.value = liste[i]['id'];
                    option.innerText = liste[i][colonne];
                    balise.appendChild(option);
                }
            }
        }

        function stopPropagation() {
            event.preventDefault();
            event.stopPropagation();
        }

        function setLiteOptions(elt, liste, colonne, id) {
            let option = document.createElement('option');
            option.innerText = `Séléctionner ${colonne}`;
            elt.appendChild(option);
            for (let i = 0; i < liste.length; i++) {
                let option = document.createElement('option');
                option.value = liste[i][id];
                option.innerText = liste[i][colonne];
                elt.appendChild(option);
            }
        }
    </script>
@stop
