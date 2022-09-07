@extends("layout.base")

@section("content")
    <div>
        <h1>Emprunt</h1>
        <form action="{{route('storeEmprunt')}}" method="post">
            @csrf
            <fieldset>
                <legend>Personnel</legend>
                <div>
                    <label for="nom">Nom</label>
                    <select name="nom" id="nom_personnes"></select>
                </div>
                <div class="alert" >
                    <p id="nom_erreur" hidden>Vous devez séléctionner le nom</p>
                </div>
                <div>
                    <label for="prenom">Prenom</label>
                    <select name="prenom" id="prenom_personnes">
                        <option>Séléctionner prénom</option>
                    </select>
                </div>
                <div class="alert" >
                    <p id="prenom_erreur" hidden>Vous devez séléctionner le prenom</p>
                </div>
            </fieldset>
            <fieldset>
                <legend>Abonné</legend>
                <div>
                    <label for="nom_abonnee">Nom</label>
                    <select name="nom_abonne" id="nom_abonnes"></select>
                </div>
                <div class="alert" >
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
                <legend>Ouvrage</legend>
                <div>
                    <div>
                        <label for="ouvrage_cote">Cote</label>
                        <input type="text" name="ouvrage_cote" id="ouvrage_cote" placeholder="Saisire l'idendifiant la cote de l'ouvrage" autocomplete="off">
                        <div class="alert" >
                            <p  id="cote_ouvrage_erreur" hidden>Le champ cote doit être renseigner</p>
                            <p  id="cote_ouvrage_not_found" hidden>Cet ouvrage n'existe pas</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="titre_ouvrage">Titre</label>
                        <input id="titre_ouvrage" type="text" name="titre">
                        <input name="data" id="data" type="text">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="etat_ouvrage">Etat ouvrage</label>
                        <select name="etat_ouvrage" id="etat_ouvrage">
                            <option selected>Séléctionner etat</option>
                           @for($i=5; $i>0; $i--)
                               <option value="{{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }}"> {{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }} </option>
                            @endfor
                        </select>
                    </div>
                    <div class="alert" >
                        <p id="etat_ouvrage_erreur" hidden>Le champ etat ouvrage est requis.</p>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Duree emprunt</legend>
                <div>
                    <label for="date_emprunt">Date Emprunt</label>
                    <input type="date" name="date_emprunt" id="date_emprunt" value="{{ date('Y-m-d') }}" disabled>
                </div>
                <div>
                    <label for="duree_emprunt">Duree Emprunt</label>
                    <select name="duree_emprunt" id="duree_emprunt">
                        <option>Sélectionner durée</option>
                        @for($i=1; $i<=4; $i++)
                            <option value="{{$i}}" {{ $i == 2 ? "selected" : "" }} > {{$i}} Semaines  </option>
                        @endfor
                    </select>

                </div>
            </fieldset>
            <div>
                <div>
                    <button name="ajouter_emprunt" id="ajouter_emprunt">Ajouter</button>
                    <input type="submit" id="action_emprunter" name="action_emprunt" value="Emprunter">
                </div>
                <div class="alert" >
                    <p id="emprunt_erreur" hidden>Veuillez ajouter cet d'ouvrage.</p>
                </div>
            </div>
            <div>
                <h3>Liste des Emprunts</h3>
                <table border="1" id="liste_emprunt">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cote</th>
                        <th>Titre ouvrage</th>
                        <th>Etat de l'ouvrage</th>
                        <th>Editer</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal_editer" id="modal_editer" hidden>
                <div>
                    <div>
                        <label for="">Etat ouvrage</label>
                        <select name="" id="etat_ouvrage_edite">
                            <option selected>Séléctionner etat</option>
                            @for($i=5; $i>0; $i--)
                                <option value="{{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }}"> {{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }} </option>
                            @endfor
                        </select>
                    </div>
                    <div class="alert" >
                        <p id="etat_ouvrage_modif_erreur" hidden>Vous devez indiquer le nombre d'exemplaire approvisionné</p>
                    </div>
                    <button id="btn_modifier">modifier</button>
                </div>
            </div>
        </form>
    </div>
@stop
@section("js")
    <script type="text/javascript" async>

        let personnels = {!! $personnels !!};
        let abonnes = {!! $abonnes !!};
        let livres_papier = {!! $livre_papier !!};
        let doc_av = {!! $document_audio_visuel !!};

        let nom_personnes = document.getElementById('nom_personnes');
        let prenom_personnes = document.getElementById('prenom_personnes');
        let nom_abonnes = document.getElementById('nom_abonnes');
        let prenom_abonnes = document.getElementById('prenom_abonnes');
        let cote_ouvrage = document.getElementById('ouvrage_cote');
        let titre = document.getElementById('titre_ouvrage');
        let etat_ouvrage = document.getElementById('etat_ouvrage');
        let donne = document.getElementById('data');
        let btn_ajouter = document.getElementById('ajouter_emprunt');
        let submit_btn = document.getElementById('action_emprunter');
        let duree_emprunt = document.getElementById('duree_emprunt');

        //let btn_modifier = document.getElementById('btn_modifier');

        let nom_erreur = document.getElementById('nom_erreur');
        let prenom_erreur = document.getElementById('prenom_erreur');
        let cote_erreur = document.getElementById('cote_ouvrage_erreur');
        let cote_no_trouve = document.getElementById('cote_ouvrage_not_found');
        let etat_ouvragae_erreur = document.getElementById('etat_ouvrage_erreur');
        let emprunts_erreur = document.getElementById('emprunt_erreur');


        setLiteOptions(nom_personnes, personnels);
        setLiteOptions(nom_abonnes, abonnes);
        cleanALl();

        let numero_ligne_edite = -1;

        btn_modifier.addEventListener('click', function (e){
           stopPropagation(e);
           modifierEtatOuvrage();
        });

        cote_ouvrage.addEventListener('keyup', function (e){
            rechercherTitreParCote();
        });

        nom_personnes.addEventListener('change', function (e){
            mettreListePrenomParNom(prenom_personnes, nom_personnes.value, personnels);
        });

        nom_abonnes.addEventListener('change', function (e){
            mettreListePrenomParNom(prenom_abonnes, nom_abonnes.value, abonnes);
        });

        function mettreListePrenomParNom(balise, elt, liste){
            while (balise.firstChild) {
                balise.removeChild(balise.firstChild);
            }
            let option = document.createElement('option');
            option.innerText = "Séléctionner prénom";
            balise.appendChild(option);
            for (let i = 0; i < liste.length; i++) {
                if(elt === liste[i]['nom']){
                    let option = document.createElement('option');
                    option.value = liste[i]['id'];
                    console.log(option.value)
                    option.innerText = liste[i]['prenom'];
                    balise.appendChild(option);
                }
            }
        }

        function stopPropagation(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function setLiteOptions(elt, liste){
            let option = document.createElement('option');
            option.innerText = "Séléctionner nom";
            elt.appendChild(option);
            for (let i = 0; i < liste.length; i++) {
                let option = document.createElement('option');
                option.value = liste[i]['nom'];
                option.innerText = option.value;
                elt.appendChild(option);
            }
        }

        let number = 1;

        btn_ajouter.addEventListener('click', function addApprovisionnement(e){
            e.preventDefault();
            if(validate()) {
                let table_body = document.getElementById('liste_emprunt').children[1];
                let row = document.createElement('tr');
                let cell_number = document.createElement('td');
                let cell_code = document.createElement('td');
                let cell_ouvrage = document.createElement('td');
                let cell_etat_ouvrage = document.createElement('td');
                let cell_supprimer = document.createElement('td');
                let cell_editer = document.createElement('td');

                let button_editer = document.createElement('button');
                let button_supprimer = document.createElement('button');

                button_editer.innerText = "Editer";
                button_editer.id = number - 1;
                button_supprimer.innerText = "Supprimer";
                button_supprimer.id = number - 1;

                button_editer.addEventListener('click', function (e){
                    stopPropagation(e);
                    editerLigne(button_editer.id);
                });

                button_supprimer.addEventListener('click', function (e){
                    stopPropagation(e);
                    removeLine(button_supprimer.id, table_body)
                });

                cell_number.innerText = number;
                cell_ouvrage.innerText = titre.value;
                cell_etat_ouvrage.innerText = etat_ouvrage.value;
                cell_code.innerText = cote_ouvrage.value;

                cell_editer.appendChild(button_editer);
                cell_supprimer.appendChild(button_supprimer);
                number++;

                row.appendChild(cell_number);
                row.appendChild(cell_code);
                row.appendChild(cell_ouvrage);
                row.appendChild(cell_etat_ouvrage);
                row.appendChild(cell_editer);
                row.appendChild(cell_supprimer);

                table_body.appendChild(row);
                cleanInput();
            }
        });

        function editerLigne(numero_ligne){
            let div_modal = document.getElementById("modal_editer");
            div_modal.hidden = false;
            //console.log(numero_ligne);
            numero_ligne_edite = numero_ligne;
        }

        function modifierEtatOuvrage(){
            //console.log("modification.... "+numero_ligne_edite);
            let table_body = document.getElementById('liste_emprunt').children[1];
            let etat_ouvrage_edite = document.getElementById('etat_ouvrage_edite');
            let lines = table_body.children;
            for (let i = 0; i < lines.length; i++) {
                if (i === parseInt(numero_ligne_edite)){
                    let line = lines[i].children;
                    line[3].innerText = etat_ouvrage_edite.value;
                    let div_modal = document.getElementById("modal_editer");
                    div_modal.hidden = true;
                    etat_ouvrage_edite.value = "Séléctionner etat";
                }
            }
        }

        function removeLine(id, table_body){
            table_body.removeChild(table_body.children[id]);
        }

        function validate(){
            if (cote_ouvrage.value === ""){
                cote_erreur.hidden = false;
                return false;
            }

            if (titre.value === "Aucun ouvrage trouvé"){
                cote_no_trouve.hidden = false;
                return false;
            }

            if (etat_ouvrage.value === "" || etat_ouvrage.value === "Séléctionner etat"){
                etat_ouvragae_erreur.hidden = false;
                return false;
            }

            return true;
        }

        function cleanInput(){
            cote_ouvrage.value = "";
            titre.value = "";
            etat_ouvrage.value = "Séléctionner etat";
        }

        function cleanALl(){
            cleanInput();
            nom_personnes.value = "Séléctionner nom";
            prenom_personnes.value = "Séléctionner prénom";
            nom_abonnes.value = "Séléctionner nom";
            prenom_abonnes.value = "Séléctionner prénom";
            donne.value = "";
        }

        function rechercherTitreParCote() {
            console.log("recherche....");
            let cote = cote_ouvrage.value;
            if (cote.substring(0, 2) === "LP"){
                for (let i = 0; i < livres_papier.length; i++) {
                    if(livres_papier[i]['cote'] === cote){
                        titre.value = livres_papier[i]['titre'];
                        return;
                    }
                }
            } else if (cote.substring(0, 2) === "DA"){
                for (let i = 0; i < doc_av.length; i++) {
                    if (doc_av[i]['cote'] === cote) {
                        titre.value = doc_av[i]['titre'];
                        return;
                    }
                }
            } else {
                titre.value = "Aucun ouvrage trouvé";
            }
        }

        // format table before send
        function formatTableDataBeforeSend()
        {
            let table_body = document.getElementById('liste_emprunt').children[1];
            let lines = table_body.children;
            for (let i = 0; i < lines.length; i++) {
                let line = lines[i].children;
                donne.value += `${dernierCarracter(line[1].innerText)},${line[3].innerText};`;
            }
        }

        function dernierCarracter(str){
            return str.substring(str.length-1, str.length);
        }

        function getType(str){
            if (str.substring(0, 2) === "LP"){
                return "livre_papier";
            } return "document_av";
        }

        submit_btn.addEventListener('click', function (e){
            console.log(donne);
            if (! validerFormulaire(e)){
                return;
            }
            formatTableDataBeforeSend();
            if (donne.value === ""){
                stopPropagation(e);
            }
            //stopPropagation(e);
        });

        function validerFormulaire(e){
            if(nom_personnes.value === "Séléctionner nom" || nom_personnes.value === ""){
                nom_erreur.hidden = false;
                stopPropagation(e);
                return false;
            }
            if(prenom_personnes.value === "Séléctionner prénom" || prenom_personnes.value === ""){
                prenom_erreur.hidden = false;
                stopPropagation(e);
                return false;
            }
            if(nom_abonnes.value === "Séléctionner nom" || nom_abonnes.value === ""){
                nom_erreur.hidden = false;
                stopPropagation(e);
                return false;
            }
            if(prenom_abonnes.value === "Séléctionner prénom" || prenom_abonnes.value === ""){
                prenom_erreur.hidden = false;
                stopPropagation(e);
                return false;
            }
            if(cote_ouvrage.value !== "" || etat_ouvrage.value !== "Séléctionner etat"){
                emprunts_erreur.hidden = false;
                stopPropagation(e);
                return false;
            }
            return true;
        }
    </script>
@stop


