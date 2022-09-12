@extends("layout.template.base")

@section("content")
    <div>
        <h1>Approvisionnements</h1>
        <form action="{{route('enregistementApprovisionnements')}}" method="post">
            @csrf
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
                <div>
                    <label for="date_approvisionement">Date</label>
                    <input type="date" name="date_approvisionnement" id="date_approvisionnement"
                           value="{{ date('Y-m-d') }}" disabled>
                </div>
            </fieldset>
            <fieldset>
                <legend>Ouvrage</legend>
                <div>
                    <div>
                        <label for="ouvrage_cote">Cote</label>
                        <input type="text" name="ouvrage_cote" id="ouvrage_cote"
                               placeholder="Saisire l'idendifiant la cote de l'ouvrage">
                        <div class="alert">
                            <p id="cote_ouvrage_erreur" hidden>Le champ cote doit être renseigner</p>
                            <p id="cote_ouvrage_not_found" hidden>Cet ouvrage n'existe pas</p>
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
                        <label for="nombre_exemplaire">Nombre d'exemplaire</label>
                        <input type="number" name="nombre_exemplaire" id="nombre_exemplaire"
                               placeholder="Saisire le nombre d'exemplaire.">
                    </div>
                    <div class="alert">
                        <p id="nombre_exemplaire_erreur" hidden>Vous devez indiquer le nombre d'exemplaire
                            approvisionné</p>
                        <p id="nombre_exemplaire_valeur_erreur" hidden>Le nombre d'exemplaire approvisionné doit être
                            supérieure à 0</p>
                    </div>
                </div>
                <div>
                    <button name="ajouter_approvisionnement" id="ajouter_approvisionnement">Ajouter</button>
                    <input type="submit" id="action_approvisionnement" name="action_approvisionnement"
                           value="Approvisionner">
                </div>
            </fieldset>
            <div>
                <h3>Liste des approvisionnements</h3>
                <table border="1" id="liste_approvisionnement">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cote</th>
                        <th>Titre ouvrage</th>
                        <th>Nombres d'exempalire</th>
                        <th>Editer</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </form>
        <div class="modal_editer" id="modal_editer" hidden>
            <div>
                <div>
                    <label for="nombre_exemplaire_edite">Nombre d'exemplaire</label>
                    <input type="number" id="nombre_exemplaire_edite" placeholder="Saisire le nombre d'exemplaire.">
                </div>
                <div class="alert">
                    <p id="nombre_exemplaire_modif_erreur" hidden>Vous devez indiquer le nombre d'exemplaire
                        approvisionné</p>
                    <p id="nombre_exemplaire_modif_valeur_erreur" hidden>Le nombre d'exemplaire approvisionné doit être
                        supérieure à 0</p>
                </div>
                <button id="btn_modifier">modifier</button>
            </div>
        </div>
    </div>
@stop
@section("js")
    <script type="text/javascript" async>

        let personnels = {!! $personnels !!};
        let livres_papier = {!! $livre_papier !!};
        let doc_av = {!! $document_audio_visuel !!};

        let nom_personnes = document.getElementById('nom_personnes');
        let prenom_personnes = document.getElementById('prenom_personnes');
        let cote_ouvrage = document.getElementById('ouvrage_cote');
        let titre = document.getElementById('titre_ouvrage');
        let nb_exemplaire = document.getElementById('nombre_exemplaire');
        let donne = document.getElementById('data');
        let terminate_btn = document.getElementById('ajouter_donnee'); //????????
        let btn_ajouter = document.getElementById('ajouter_approvisionnement');
        let submit_btn = document.getElementById('action_approvisionnement');
        let btn_modifier = document.getElementById('btn_modifier');

        let nom_erreur = document.getElementById('nom_erreur');
        let prenom_erreur = document.getElementById('prenom_erreur');
        let cote_erreur = document.getElementById('cote_ouvrage_erreur');
        let cote_no_trouve = document.getElementById('cote_ouvrage_not_found');
        let nb_exemplaire_erreur = document.getElementById('nombre_exemplaire_erreur');
        let nb_exemplaire_valeur_erreur = document.getElementById('nombre_exemplaire_valeur_erreur');

        let numero_ligne_edite = -1;

        setLiteNoms(nom_personnes);
        cleanALl();

        btn_modifier.addEventListener('click', function (e) {
            stopPropagation(e);
            modifierNbExemplaire();
        });

        cote_ouvrage.addEventListener('keyup', function (e) {
            rechercherTitreParCote();
        });

        nom_personnes.addEventListener('change', function (e) {
            while (prenom_personnes.firstChild) {
                prenom_personnes.removeChild(prenom_personnes.firstChild);
            }
            let option = document.createElement('option');
            option.innerText = "Séléctionner prénom";
            prenom_personnes.appendChild(option);
            for (let i = 0; i < personnels.length; i++) {
                if (nom_personnes.value == personnels[i]['nom']) {
                    let option = document.createElement('option');
                    option.value = personnels[i]['id_personnel'];
                    option.innerText = personnels[i]['prenom'];
                    prenom_personnes.appendChild(option);
                }
            }
        });

        function stopPropagation(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function setLiteNoms(nom_personnes) {
            let option = document.createElement('option');
            option.innerText = "Séléctionner nom";
            nom_personnes.appendChild(option);
            for (let i = 0; i < personnels.length; i++) {
                let option = document.createElement('option');
                option.value = personnels[i]['nom'];
                option.innerText = option.value;
                nom_personnes.appendChild(option);
            }
        }

        let number = 1;

        btn_ajouter.addEventListener('click', function addApprovisionnement(e) {
            e.preventDefault();
            if (validate()) {
                let table_body = document.getElementById('liste_approvisionnement').children[1];
                let row = document.createElement('tr');
                let cell_number = document.createElement('td');
                let cell_code = document.createElement('td');
                let cell_ouvrage = document.createElement('td');
                let cell_nb_exemplaire = document.createElement('td');
                let cell_editer = document.createElement('td');
                let cell_supprimer = document.createElement('td');

                let button_editer = document.createElement('button');
                let button_supprimer = document.createElement('button');

                button_editer.innerText = "Editer";
                button_supprimer.innerText = "Supprimer";
                button_editer.id = number - 1;
                button_supprimer.id = number - 1;

                button_editer.addEventListener('click', function (e) {
                    stopPropagation(e);
                    editerLigne(button_editer.id);
                });

                button_supprimer.addEventListener('click', function (e) {
                    stopPropagation(e);
                    removeLine(button_supprimer.id, table_body)
                });

                cell_number.innerText = number;
                cell_ouvrage.innerText = titre.value;
                cell_nb_exemplaire.innerText = nb_exemplaire.value;
                cell_code.innerText = cote_ouvrage.value;

                cell_editer.appendChild(button_editer);
                cell_supprimer.appendChild(button_supprimer);
                number++;

                row.appendChild(cell_number);
                row.appendChild(cell_code);
                row.appendChild(cell_ouvrage);
                row.appendChild(cell_nb_exemplaire);
                row.appendChild(cell_editer);
                row.appendChild(cell_supprimer);

                table_body.appendChild(row);
                cleanInput();
            }
        });

        function editerLigne(numero_ligne) {
            let div_modal = document.getElementById("modal_editer");
            div_modal.hidden = false;
            console.log(numero_ligne);
            numero_ligne_edite = numero_ligne;
        }

        function modifierNbExemplaire() {
            console.log("modification.... " + numero_ligne_edite);
            let table_body = document.getElementById('liste_approvisionnement').children[1];
            let lines = table_body.children;
            for (let i = 0; i < lines.length; i++) {
                if (i === parseInt(numero_ligne_edite)) {
                    let line = lines[i].children;
                    line[3].innerText = nombre_exemplaire_edite.value;
                    let div_modal = document.getElementById("modal_editer");
                    div_modal.hidden = true;
                    nombre_exemplaire_edite.value = "";
                }
            }
        }

        function removeLine(id, table_body) {
            table_body.removeChild(table_body.children[id]);
        }

        function validate() {
            if (cote_ouvrage.value === "") {
                cote_erreur.hidden = false;
                return false;
            }

            if (titre.value === "Aucun ouvrage trouvé") {
                cote_no_trouve.hidden = false;
                return false;
            }

            if (nb_exemplaire.value === "") {
                nb_exemplaire_erreur.hidden = false;
                return false;
            }

            if (nb_exemplaire.value <= 0) {
                nb_exemplaire_valeur_erreur.hidden = false;
                return false;
            }

            return true;
        }

        function cleanInput() {
            cote_ouvrage.value = "";
            titre.value = "";
            nb_exemplaire.value = "";
        }

        function cleanALl() {
            cleanInput();
            nom_personnes.value = "Séléctionner nom";
            prenom_personnes.value = "Séléctionner prénom";
            data.value = "";
        }

        function rechercherTitreParCote() {
            let cote = cote_ouvrage.value;
            if (cote.substring(0, 2) === "LP") {
                console.log("LP---Yes");
                for (let i = 0; i < livres_papier.length; i++) {
                    if (livres_papier[i]['cote'] === cote) {
                        titre.value = livres_papier[i]['titre'];
                        return;
                    }
                }
            } else if (cote.substring(0, 2) === "DA") {
                console.log("DA---Yes");
                for (let i = 0; i < doc_av.length; i++) {
                    if (doc_av[i]['cote'] == titre) {
                        titre.value = doc_av[i]['titre'];
                        return;
                    }
                }
            } else {
                titre.value = "Aucun ouvrage trouvé";
            }
        }

        // format table before send
        function formatTableDataBeforeSend() {
            let table_body = document.getElementById('liste_approvisionnement').children[1];
            let lines = table_body.children;
            for (let i = 0; i < lines.length; i++) {
                submit_btn.disabled = false;
                let line = lines[i].children;
                data.value += `${dernierCarracter(line[1].innerText)},${line[3].innerText},${prenom_personnes.value};`;
            }
        }

        function dernierCarracter(str) {
            return str.substring(str.length - 1, str.length);
        }

        function getType(str) {
            if (str.substring(0, 2) === "LP") {
                return "livre_papier";
            }
            return "document_av";
        }

        submit_btn.addEventListener('click', function (e) {
            console.log("OKKKKKKKK..............");
            if (nom_personnes.value === "Séléctionner nom" || nom_personnes.value === "") {
                nom_erreur.hidden = false;
                stopPropagation(e);
                return;
            }
            console.log("OKKKKKKKK..............2222");
            if (prenom_personnes.value === "Séléctionner prénom" || prenom_personnes.value === "") {
                prenom_erreur.hidden = false;
                stopPropagation(e);
                return;
            }
            console.log("OKKKKKKKK..............3333");
            formatTableDataBeforeSend();
            if (data.value === "") {
                stopPropagation(e);
                return;
            }
        });
    </script>
@stop


