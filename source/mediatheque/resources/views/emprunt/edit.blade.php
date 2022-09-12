@extends("layout.template.base")

@section("content")

    <div>
        <h1>Editer l'emprunt N° {{ $emprunt->id_emprunt }}</h1>
        <form action="{{route('updateEmprunt', $emprunt)}}" method="post">
            @csrf
            {{ method_field('PUT') }}
            <fieldset>
                <legend>Personnel</legend>
                <div>
                    <label for="nom">Nom</label>
                    <select name="nom" id="nom_personnes"></select>
                </div>
                <div class="alert">
                    <p id="nom_erreur" hidden>Vous devez séléctionner le nom</p>
                </div>
                <div>
                    <label for="prenom">Prenom</label>
                    <select name="prenom" id="prenom_personnes">
                        <option>Séléctionner prénom</option>
                    </select>
                </div>
                <div class="alert">
                    <p id="prenom_erreur" hidden>Vous devez séléctionner le prenom</p>
                </div>
            </fieldset>
            <fieldset>
                <legend>Abonné</legend>
                <div>
                    <label for="nom_abonnee">Nom</label>
                    <select name="nom_abonne" id="nom_abonnes"></select>
                </div>
                <div class="alert">
                    <p id="nom_abonne_erreur" hidden>Vous devez séléctionner le nom</p>
                </div>
                <div>
                    <label for="prenom_abonne">Prenom</label>
                    <select name="prenom_abonne" id="prenom_abonnes">
                        <option>Séléctionner prénom</option>
                    </select>
                </div>
                <div class="alert">
                    <p id="prenom_abonne_erreur" hidden>Vous devez séléctionner le prenom</p>
                </div>
            </fieldset>
            <fieldset>
                <legend>Duree emprunt</legend>
                <div>
                    <label for="date_emprunt">Date Emprunt</label>
                    <input type="date" name="date_emprunt" id="date_emprunt"
                           value="{{ App\Service\GlobaleService::afficherDate($emprunt->date_emprunt) }}" disabled>
                </div>
                <div>
                    <label for="duree_emprunt">Duree Emprunt</label>
                    <select name="duree_emprunt" id="duree_emprunt">
                        <option>Sélectionner durée</option>
                        @for($i=1; $i<=4; $i++)
                            <option value="{{$i}}" {{ $i == 2 ? "selected" : "" }} > {{$i}} Semaines</option>
                        @endfor
                    </select>

                </div>
            </fieldset>
            <div>
                <div>
                    <button name="modifier_emprunt" id="modifier_emprunt">Modifier</button>
                </div>
            </div>
        </form>
    </div>
@stop
@section("js")
    <script type="text/javascript" async>

        let personnels = {!! $personnels !!};
        let abonnes = {!! $abonnes !!};
        let nom_personnel = "{!! $emprunt->personnel->utilisateur->nom !!}";
        let prenom_personnel = "{!! $emprunt->personnel->utilisateur->prenom !!}";
        let nom_abonne = "{!! $emprunt->abonne->utilisateur->nom !!}";
        let prenom_abonne = "{!! $emprunt->abonne->utilisateur->prenom !!}";
        //console.log(personnels);

        let nom_personnes = document.getElementById('nom_personnes');
        let prenom_personnes = document.getElementById('prenom_personnes');
        let nom_abonnes = document.getElementById('nom_abonnes');
        let prenom_abonnes = document.getElementById('prenom_abonnes');


        setLiteOptions(nom_personnes, personnels, prenom_personnes, personnels);
        setLiteOptions(nom_abonnes, abonnes, prenom_abonnes, abonnes);

        nom_personnes.addEventListener('change', function (e) {
            mettreListePrenomParNom(prenom_personnes, nom_personnes.value, personnels);
        });

        nom_abonnes.addEventListener('change', function (e) {
            mettreListePrenomParNom(prenom_abonnes, nom_abonnes.value, abonnes);
        });

        function setLiteOptions(elt, liste, prenoms, liste) {
            let option = document.createElement('option');
            option.innerText = "Séléctionner nom";
            let nom;
            elt.appendChild(option);
            for (let i = 0; i < liste.length; i++) {
                let option = document.createElement('option');
                option.value = liste[i]['nom'];
                option.innerText = option.value;
                if (option.value === nom_personnel || option.value === nom_abonne) {
                    option.selected = true;
                    nom = option.innerText;
                }
                //console.log(option.value);

                elt.appendChild(option);
            }
            //console.log("nom");
            //console.log(nom);
            mettreListePrenomParNom(prenoms, nom, liste);

        }


        function mettreListePrenomParNom(balise, elt, liste) {

            while (balise.firstChild) {
                balise.removeChild(balise.firstChild);
            }
            let option = document.createElement('option');
            option.innerText = "Séléctionner prénom";
            balise.appendChild(option);
            for (let i = 0; i < liste.length; i++) {

                if (elt === liste[i]['nom']) {
                    let option = document.createElement('option');
                    option.value = liste[i]['id'];
                    if (liste[i]['prenom'] === prenom_personnel || liste[i]['prenom'] === prenom_abonne) {
                        option.selected = true;
                    }
                    //console.log(option.value)
                    option.innerText = liste[i]['prenom'];
                    balise.appendChild(option);
                }
            }
        }

    </script>
@stop



