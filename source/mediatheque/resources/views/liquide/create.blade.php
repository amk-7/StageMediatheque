@extends('layout.template.base')

@section('content')
<div>
    <h1>Registrations</h1>
    <form action="{{route('storeLiquide')}}" method="post">
        @csrf
        <fieldset>
            <legend>Personnel</legend>
            <div>
                <label>Nom</label>
                <select name="nom_personnes", id="nom_personnes">
                </select>
            </div>
            <div>
                <label>Prénom</label>
                <select name="prenom_personnes" id="prenom_personnes">
                    <option>Séléctionner prénom</option>
                </select>
            </div>
        </fieldset>
       <fieldset>
           <legend>Abonne</legend>
           <div>
               <label>Nom</label>
               <select name="nom_abonnes", id="nom_abonnes">
               </select>
           </div>
           <div>
               <label>Prénom</label>
               <select name="prenom_abonnes" id="prenom_abonnes">
                   <option>Séléctionner prénom</option>
               </select>
           </div>
       </fieldset>
        <fieldset>
            <legend>Abonnement</legend>
            <div>
                <label>Type</label>
                <select name="tarifs" id="tarifs">
                </select>
                <label>
                    <span>Montant: </span>
                    <span id="montant">0 FCFA</span>
                </label>
            </div>
            <div>
                <label>
                    <span>Payé: </span>
                </label>
                <div>
                    <input type="radio" name="paye" value="oui" checked>Oui</input>
                    <input type="radio" name="paye" value="non">Non</input>
                </div>
            </div>
        </fieldset>
        <input type="submit" value="Enregistré">
    </form>
</div>
@endsection
@section("js")
    <script type="text/javascript" async>

        let personnels = {!! $personnels !!};
        let abonnes = {!! $abonnes !!};
        let tarifs = {!! $tarifs !!};

        let nom_personnes = document.getElementById('nom_personnes');
        let prenom_personnes = document.getElementById('prenom_personnes');
        let nom_abonnes = document.getElementById('nom_abonnes');
        let prenom_abonnes = document.getElementById('prenom_abonnes');
        let balise_tarifs = document.getElementById('tarifs')

        let submit_btn = document.getElementById('action_registrer');
        setLiteOptions(nom_personnes, personnels, "nom");
        setLiteOptions(nom_abonnes, abonnes, "nom");
        setLiteOptions(balise_tarifs, tarifs, "designation");
        //cleanALl();
        nom_personnes.addEventListener('change', function (e) {
            mettreListePrenomParNom(prenom_personnes, nom_personnes.value, personnels, "prenom");
        });

        nom_abonnes.addEventListener('change', function (e) {
            mettreListePrenomParNom(prenom_abonnes, nom_abonnes.value, abonnes, "prenom");
        });
        balise_tarifs.addEventListener('change', function (e){

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

        function setLiteOptions(elt, liste, colonne) {
            let option = document.createElement('option');
            option.innerText = `Séléctionner ${colonne}`;
            elt.appendChild(option);
            for (let i = 0; i < liste.length; i++) {
                let option = document.createElement('option');
                option.value = liste[i][colonne];
                option.innerText = option.value;
                elt.appendChild(option);
            }
        }
    </script>
@stop
