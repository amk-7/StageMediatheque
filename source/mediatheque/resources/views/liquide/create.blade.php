@extends('layout.template.base')

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
                <label class="label">Type</label>
                <select name="tarifs" id="tarifs" class="select_btn">
                </select>
                <label class="label">
                    <span>Montant: </span>
                    <span id="montant">0 FCFA</span>
                </label>
            </div>
        </fieldset>
        <input type="submit" value="Enregistré">
    </form>
</div>
@endsection
@section("js")
    <script type="text/javascript" async>

        let abonnes = {!! $abonnes !!};
        let tarifs = {!! $tarifs !!};

        console.log(tarifs);
    
        let nom_abonnes = document.getElementById('nom_abonnes');
        let prenom_abonnes = document.getElementById('prenom_abonnes');
        let balise_tarifs = document.getElementById('tarifs');
        let montant = document.getElementById('montant');

        let submit_btn = document.getElementById('action_registrer');
        setLiteOptions(nom_abonnes, abonnes, "nom", 'nom');
        setLiteOptions(balise_tarifs, tarifs, "designation", 'id_tarif_abonnement');
        //cleanALl();

        nom_abonnes.addEventListener('change', function (e) {
            mettreListePrenomParNom(prenom_abonnes, nom_abonnes.value, abonnes, "prenom");
        });
        balise_tarifs.addEventListener('change', function (e){
            setMontant(this.value);
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

        function setMontant(tarif) {
            for (let i = 0; i < tarifs.length; i++) {
                if (tarif == tarifs[i]['id_tarif_abonnement']) {
                    montant.innerText = tarifs[i]['tarif']+" FCFA";
                    return ;
                }
            }
        }
    </script>
@stop
