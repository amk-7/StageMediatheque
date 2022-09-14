@extends("layout.template.base")

@section("content")
    <div>
        <h1>Restitution de l'emprunt N° EMP{{ $emprunt->id_emprunt }}</h1>
        <h4>Date : </h4>
        <form action="{{route('enregistementRestitution')}}" method="post">
            @csrf
            <fieldset>
                <legend>Personnel</legend>
                <div>
                    <label>
                        <span>Nom : </span>
                        <span> {{ $emprunt->personnel->utilisateur->nom }} </span>
                    </label>
                </div>
                <div>
                    <label>
                        <span>Prenom : </span>
                        <span> {{ $emprunt->personnel->utilisateur->prenom }} </span>
                    </label>
                </div>
            </fieldset>
            <fieldset>
                <legend>Abonné</legend>
                <div>
                    <label>
                        <span>Nom : </span>
                        <span> {{ $emprunt->abonne->utilisateur->nom }} </span>
                    </label>
                </div>
                <div>
                    <label>
                        <span>Prénom : </span>
                        <span> {{ $emprunt->abonne->utilisateur->prenom }} </span>
                    </label>
                </div>
            </fieldset>
            <fieldset>
                <legend>Ouvrages emprunté</legend>
                <div>
                    <input type="text" name="data" id="data">
                    <table border="1" id="liste_restitution">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Cote</th>
                            <th>Titre ouvrage</th>
                            <th>Etat sortie</th>
                            <th>Etat entrée</th>
                            <th>Restituer</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div>
                    <input type="submit" id="action_restituer" name="action_restituer" value="Restituer">
                </div>
            </fieldset>
        </form>
        <div class="modal_editer" id="modal_editer" hidden>
            <div>
                <div>
                    <label>Etat entree</label>
                    <select name="" id="etat_entree_ouvrage_edite">
                        <option selected>Séléctionner etat</option>
                        @for($i=5; $i>0; $i--)
                            <option value="{{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }}"> {{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }} </option>
                        @endfor
                    </select>
                </div>
                <div class="alert">
                    <p id="etat_ouvrage_modif_erreur" hidden>Vous l'état de retour de l'ouvrage .</p>
                </div>
                <button id="btn_modifier">modifier</button>
            </div>
        </div>
    </div>
@stop
@section("js")
    <script type="text/javascript" async>

        let number = 1;
        let id_emprunt = {!! $emprunt->id_emprunt !!};
        let id_personnel = {{ $emprunt->personnel->id_personnel }};
        let id_abonne = {{ $emprunt->abonne->id_abonne }};
        let lignes_emprunt = {!! $lignes_emprunt !!};

        let donne = document.getElementById('data');
        let submit_btn = document.getElementById('action_restituer');
        let btn_modifier = document.getElementById('btn_modifier');

        cleanALl();

        donne.value = `${id_emprunt},${id_personnel},${id_abonne};`;
        mettreLignesEmprunt();
        let numero_ligne_edite = -1;

        btn_modifier.addEventListener('click', function (e) {
            stopPropagation(e);
            modifierEtatEntreeOuvrage();
        });


        function stopPropagation(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function mettreLignesEmprunt() {
            for (let i = 0; i < lignes_emprunt.length; i++) {
                console.log("Ok...");
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
                cell_etat_entree.innerText = "";
            } else {
                cell_restituer.innerText = "Restituer";
                cell_etat_entree.innerText = etat_entree;
            }

            cell_number.innerText = number;
            cell_cote.innerText = cote;
            cell_ouvrage.innerText = titre_ouvrage;
            cell_etat_sortie.innerText = etat_sortie;

            number++;

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
            let div_modal = document.getElementById("modal_editer");
            if (checkbox.checked) {
                div_modal.hidden = false;
                numero_ligne_edite = numero_ligne;
            } else {
                div_modal.hidden = true;
                let table_body = document.getElementById('liste_restitution').children[1];
                let etat_entree_ouvrage_edite = document.getElementById('etat_entree_ouvrage_edite');
                let line = table_body.children[numero_ligne_edite];
                let cellules = line.children;
                cellules[4].innerText = "";
            }
        }

        function modifierEtatEntreeOuvrage() {
            //console.log("modification.... "+numero_ligne_edite);
            let table_body = document.getElementById('liste_restitution').children[1];
            let etat_entree_ouvrage_edite = document.getElementById('etat_entree_ouvrage_edite');
            let line = table_body.children[numero_ligne_edite];
            console.log(line);
            let cellules = line.children;
            cellules[4].innerText = etat_entree_ouvrage_edite.value;
            let div_modal = document.getElementById("modal_editer");
            div_modal.hidden = true;
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
                if (line[4].innerText !== "") {
                    donne.value += `${dernierCarracter(line[1].innerText)},${line[4].innerText};`;
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


