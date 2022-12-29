@extends("layout.template.base")

@section("content")
    <div class="flex flex-col items-center space-y-3">
        <h1 class="label_title">Restitution de l'emprunt N° EMP{{ $restitution->emprunt->id_emprunt }}</h1>
        <h4 class="label_title_sub_title">Date : {{ $restitution->date_restitution }} </h4>
        <form action="{{route('modificationRestitution', $restitution)}}" method="post">
            @csrf
            <fieldset class="fieldset_border">
                <legend>Personnel</legend>
                <div>
                    <label>
                        <span>Nom : </span>
                        <span> {{ $restitution->emprunt->personnel->utilisateur->nom }} </span>
                    </label>
                </div>
                <div>
                    <label>
                        <span>Prenom : </span>
                        <span> {{ $restitution->emprunt->personnel->utilisateur->prenom }} </span>
                    </label>
                </div>
            </fieldset>
            <fieldset class="fieldset_border">
                <legend>Abonné</legend>
                <div>
                    <label>
                        <span>Nom : </span>
                        <span> {{ $restitution->emprunt->abonne->utilisateur->nom }} </span>
                    </label>
                </div>
                <div>
                    <label>
                        <span>Prénom : </span>
                        <span> {{ $restitution->emprunt->abonne->utilisateur->prenom }} </span>
                    </label>
                </div>
            </fieldset>
            <fieldset class="fieldset_border flex flex-col items-center space-y-4">
                <legend>Ouvrages emprunté</legend>
                <div>
                    <input type="text" name="data" id="data" class="hidden" hidden>
                    <table border="1" id="liste_restitution">
                        <thead>
                        <tr>
                            <th class="fieldset_border">N°</th>
                            <th class="fieldset_border">Cote</th>
                            <th class="fieldset_border">Titre ouvrage</th>
                            <th class="fieldset_border">Etat sortie</th>
                            <th class="fieldset_border">Etat entrée</th>
                            <th class="fieldset_border">Restituer</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div>
                    <input type="submit" id="action_restituer" class="button button_primary" name="action_restituer" value="Restituer">
                </div>
            </fieldset>
        </form>
        <!-- Overlay element -->
        <div id="overlay" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
        <div class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_editer">
            <div class="flex flex-col items-center space-y-4">
                <div>
                    <label>Etat entree</label>
                    <select name="" id="etat_entree_ouvrage_edite">
                        <option selected>Séléctionner etat</option>
                        @for($i=4; $i>0; $i--)
                            <option value="{{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }}"> {{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }} </option>
                        @endfor
                    </select>
                </div>
                <div class="alert">
                    <p id="etat_ouvrage_modif_erreur" hidden>Vous devez renseigner l'état de l'ouvrage restituer .</p>
                </div>
                <button id="btn_modifier" class="button button_primary">modifier</button>
            </div>
        </div>
    </div>
@stop
@section("js")
    <script type="text/javascript" async>

        let number = 1;
        let restitution = {!! $restitution !!};
        let id_emprunt = {!! $restitution->emprunt->id_emprunt !!};
        let id_personnel = {{ $restitution->emprunt->personnel->id_personnel }};
        let id_abonne = {{ $restitution->emprunt->abonne->id_abonne }};
        let lignes_emprunt = {!! $lignes_emprunt !!};
        let donne = document.getElementById('data');
        let submit_btn = document.getElementById('action_restituer');
        let btn_modifier = document.getElementById('btn_modifier');

        let overlay = document.getElementById('overlay');
        let box_erreur = document.getElementById('erreur_msg_box');
        let msg_value = document.getElementById('erreur_msg_value');
        let div_modal = document.getElementById("modal_editer");


        if(restitution['etat']){
            submit_btn.hidden = true;
            submit_btn.classList += "hidden";
        }
        cleanALl();

        donne.value = `${id_emprunt},${id_personnel},${id_abonne};`;
        mettreLignesEmprunt();
        let numero_ligne_edite = -1;

        btn_modifier.addEventListener('click', function (e) {
            stopPropagation();
            modifierEtatEntreeOuvrage();
        });


        function stopPropagation() {
            event.preventDefault();
            event.stopPropagation();
        }
        console.log(lignes_emprunt);
        function mettreLignesEmprunt() {
            for (let i = 0; i < lignes_emprunt.length; i++) {
                mettreUneLigneEmprunt(lignes_emprunt[i]['cote'], lignes_emprunt[i]['titre_ouvrage'], lignes_emprunt[i]['etat_sortie'], lignes_emprunt[i]['disponibilite'], lignes_emprunt[i]['etat_entree']);
            }
        }

        function mettreUneLigneEmprunt(cote, titre_ouvrage, etat_sortie, disponibilite, etat_entree) {
            let table_body = document.getElementById('liste_restitution').children[1];
            let row = document.createElement('tr');
            let cell_number = document.createElement('td');
            let cell_cote = document.createElement('td');
            let cell_ouvrage = document.createElement('td');
            let cell_etat_sortie = document.createElement('td');
            let cell_etat_entree = document.createElement('td');
            let cell_restituer = document.createElement('td');

            if (!disponibilite) {
                let check_restituer = document.createElement('input');
                check_restituer.type = 'checkbox';
                check_restituer.id = number - 1;
                check_restituer.addEventListener('click', function (e) {
                    editerLigne(check_restituer.id);
                });
                cell_restituer.appendChild(check_restituer);
                cell_etat_entree.innerText = "-";
            } else {
                cell_restituer.innerText = "Restituer";
                cell_etat_entree.innerText = etat_entree;
            }

            cell_number.innerText = number;
            cell_cote.innerText = cote;
            cell_ouvrage.innerText = titre_ouvrage;
            cell_etat_sortie.innerText = etat_sortie;

            number++;
            cell_number.classList = "fieldset_border"
            cell_cote.classList = "fieldset_border"
            cell_ouvrage.classList = "fieldset_border"
            cell_etat_sortie.classList = "fieldset_border"
            cell_etat_entree.classList = "fieldset_border"
            cell_restituer.classList = "fieldset_border"

            row.appendChild(cell_number);
            row.appendChild(cell_cote);
            row.appendChild(cell_ouvrage);
            row.appendChild(cell_etat_sortie);
            row.appendChild(cell_etat_entree);
            row.appendChild(cell_restituer);
            table_body.appendChild(row);
        };

        function editerLigne(numero_ligne) {
            let checkbox = document.getElementById(numero_ligne);

            if (checkbox.checked) {
                div_modal.classList.remove('hidden');
                overlay.classList.remove('hidden');
                numero_ligne_edite = numero_ligne;
            } else {
                /*div_modal.classList.add('hidden');
                overlay.classList.add('hidden');*/
                let table_body = document.getElementById('liste_restitution').children[1];
                let etat_entree_ouvrage_edite = document.getElementById('etat_entree_ouvrage_edite');
                let line = table_body.children[numero_ligne_edite];
                let cellules = line.children;
                cellules[4].innerText = "";
            }
        }

        function modifierEtatEntreeOuvrage() {
            let table_body = document.getElementById('liste_restitution').children[1];
            let etat_entree_ouvrage_edite = document.getElementById('etat_entree_ouvrage_edite');
            if (etat_entree_ouvrage_edite.value === "Séléctionner etat"){
                let erreur = document.getElementById("etat_ouvrage_modif_erreur");
                erreur.hidden = false;
                return ;
            }
            let line = table_body.children[numero_ligne_edite];
            console.log(line);
            let cellules = line.children;
            cellules[4].innerText = etat_entree_ouvrage_edite.value;
            div_modal.classList.add('hidden');
            overlay.classList.add('hidden');
            etat_entree_ouvrage_edite.value = "Séléctionner etat";
        }

        function removeLine(id, table_body) {
            table_body.removeChild(table_body.children[id]);
        }

        function cleanALl() {
            donne.value = "";
        }

        // format table before send
        function formatTableDataBeforeSend() {
            let table_body = document.getElementById('liste_restitution').children[1];
            let lines = table_body.children;
            for (let i = 0; i < lines.length; i++) {
                let line = lines[i].children;
                if (line[5].innerText !== "Restituer") {
                    if (line[4].innerText !== "") {
                        donne.value += `${dernierCarracter(line[1].innerText)},${line[4].innerText};`;
                    }
                }
            }
        }

        function dernierCarracter(str) {
            return str.substring(str.length - 6, str.length);
        }

        function getType(str) {
            if (str.substring(0, 2) === "LP") {
                return "livre_papier";
            }
            return "document_av";
        }

        submit_btn.addEventListener('click', function (e) {
            formatTableDataBeforeSend();
            if (donne.value === "") {
                stopPropagation(e);
            }
        });
    </script>
@stop


