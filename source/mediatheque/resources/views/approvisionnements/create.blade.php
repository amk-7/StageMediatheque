@extends("layout.base")

@section("content")
    <div>
        <h1>Approvisionnements</h1>
        <form action="{{route('enregistementApprovisionnements')}}" method="post">
            @csrf
            <fieldset>
                <legend>Personnel</legend>
                <div>
                    <label for="nom_personne">Nom</label>
                    <select name="nom_personne" id="nom_personnes"></select>
                </div>
                <div>
                    <label for="prenom_personne">Prenom</label>
                    <select name="id_personnel" id="prenom_personnes"></select>
                </div>
                <div class="erreur" >
                    <p id="prenom_erreur" hidden>Vous devez séléctionner le prenom</p>
                </div>
                <div>
                    <label for="date_approvisionement">Date</label>
                    <input type="date" name="date_approvisionnement" id="date_approvisionnement" value="{{ date('Y-m-d') }}">
                </div>
            </fieldset>
            <fieldset>
                <legend>Ouvrage</legend>
                <div>
                    <div>
                        <label for="type_ouvrage">Type de l'ouvrage</label>
                        <select name="type_ouvrage" id="type_ouvrage">
                            <option value="">--Séléctionner type--</option>
                            <option value="livre_papier">Livre papier</option>
                            <option value="document_audio_visuel">Document audio visuel</option>
                        </select>
                    </div>
                    <div class="erreur" >
                        <p id="type_ouvrage_erreur" hidden>Vous devez séléctionner le type de l'ouvrage</p>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="ouvrage_code_id">Identifiant</label>
                        <input type="text" name="ouvrage_code_id" id="ouvrage_code_id" placeholder="Saisire l'idendifiant (ISBN ou ISAN).">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="titre_ouvrage">Titre</label>
                        <input id="titre_ouvrage" type="search" name="titre">
                        <ul id="searche_options">

                        </ul>
                        <input name="data" id="data" type="text">
                    </div>
                    <div class="erreur" >
                        <p  id="titre_ouvrage_erreur" hidden>Le champ titre doit être renseigner</p>
                        <p  id="titre_ouvrage_not_found" hidden>Cet ouvrage n'existe pas</p>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="nombre_exemplaire">Nombre d'exemplaire</label>
                        <input type="number" name="nombre_exemplaire" id="nombre_exemplaire" placeholder="Saisire le nombre d'exemplaire.">
                    </div>
                    <div class="erreur" >
                        <p id="nombre_exemplaire_erreur" hidden>Vous devez indiquer le nombre d'exemplaire approvisionné</p>
                    </div>
                </div>
                <div>
                    <button name="ajouter_approvisionnement" id="ajouter_approvisionnement">Ajouter</button>
                    <button name="ajouter_donnee" id="ajouter_donnee">Terminer</button>
                    <input type="submit" disabled id="action_approvisionnement" name="action_approvisionnement" value="Approvisionner">
                </div>
            </fieldset>
            <div>
                <h3>Liste des approvisionnements</h3>
                <table border="1" id="liste_approvisionnement">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Identifiant</th>
                        <th>Ouvrage</th>
                        <th>Type</th>
                        <th>Nombre d'exempalire</th>
                        <th>Editer</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </form>
        <div class="modal_editer" id="modal_editer">
            <div>
                <div>
                    <label for="nombre_exemplaire_edite">Nombre d'exemplaire</label>
                    <input type="number" id="nombre_exemplaire_edite" placeholder="Saisire le nombre d'exemplaire.">
                </div>
                <button>modifier</button>
            </div>
        </div>
    </div>
    @section("js")
        <script type="text/javascript" async>

            let personnels = {!! $personnels !!};
            let livres_papier = {!! $livre_papier !!};
            let doc_av = {!! $document_audio_visuel !!};

            let type_ouvrage_error = document.getElementById('type_ouvrage_erreur');
            let titre_error = document.getElementById('titre_ouvrage_erreur');
            let titre_not_found = document.getElementById('titre_ouvrage_not_found');
            let nb_exemplaire_error = document.getElementById('nombre_exemplaire_erreur');
            let prenom_erreur = document.getElementById('prenom_erreur');

            let nom_personnes = document.getElementById('nom_personnes');
            let prenom_personnes = document.getElementById('prenom_personnes');

            setLiteNoms(nom_personnes);
            nom_personnes.addEventListener('change', function (e){
                while (prenom_personnes.firstChild) {
                    prenom_personnes.removeChild(prenom_personnes.firstChild);
                }
                let option = document.createElement('option');
                option.innerText = "Séléctionner prenom";
                prenom_personnes.appendChild(option);
                for (let i = 0; i < personnels.length; i++) {
                    if(nom_personnes.value==personnels[i]['nom']){
                        let option = document.createElement('option');
                        option.value = personnels[i]['id_personnel'];
                        option.innerText = personnels[i]['prenom'];
                        prenom_personnes.appendChild(option);
                    }
                }
            });

            prenom_personnes.addEventListener('change', function (e){
                prenom_erreur.hidden = true;
            });

            function setLiteNoms(nom_personnes){
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


            function stopPropagation() {
                event.preventDefault();
            }

            let btn_ajouter = document.getElementById('ajouter_approvisionnement');

            let number = 1;
            let type_ouvrage = document.getElementById('type_ouvrage');
            let identifiant = document.getElementById('ouvrage_code_id');
            let titre = document.getElementById('titre_ouvrage');
            let nb_exemplaire = document.getElementById('nombre_exemplaire');
            let data = document.getElementById('data');

            type_ouvrage.addEventListener("change", function (e){
                console.log(type_ouvrage.value);
                let ul = document.getElementById("searche_options")
                while (ul.firstChild) {
                    ul.removeChild(ul.firstChild);
                }
                if(type_ouvrage.value == 'livre_papier'){
                    for (let i = 0; i < livres_papier.length; i++) {
                        let li = document.createElement('li')
                        li.className = "ouvrages_titre";
                        li.innerText = livres_papier[i]["titre"];
                        li.id=`titre${i}`;
                        li.addEventListener("click", function () {
                            applySelected(`titre${i}`, select_attribute);
                        }, false);
                        ul.appendChild(li);
                    }
                }else if(type_ouvrage.value == 'document_audio_visuel'){
                    for (let i = 0; i < doc_av.length; i++) {
                        let li = document.createElement('li')
                        li.className = "ouvrages_titre";
                        li.innerText = doc_av[i]["titre"];
                        li.id=`titre${i}`;
                        li.addEventListener("click", function () {
                            applySelected(`titre${i}`, select_attribute);
                        }, false);
                        ul.appendChild(li);
                    }
                }
                type_ouvrage_error.hidden = true;
            });

            btn_ajouter.addEventListener('click', function addApprovisionnement(e){
                e.preventDefault();
                if(validate()) {
                    let table_body = document.getElementById('liste_approvisionnement').children[1];
                    let row = document.createElement('tr');
                    let cell_number = document.createElement('td');
                    let cell_ouvrage = document.createElement('td');
                    let cell_type = document.createElement('td');
                    let cell_nb_exemplaire = document.createElement('td');
                    let cell_code = document.createElement('td');
                    let cell_editer = document.createElement('td');
                    let cell_supprimer = document.createElement('td');

                    let button_editer = document.createElement('button');
                    let button_supprimer = document.createElement('button');

                    button_editer.innerText = "Editer";
                    button_supprimer.innerText = "Supprimer";
                    button_editer.id = number - 1;
                    button_supprimer.id = number - 1;

                    button_supprimer.addEventListener('click', function (e){
                        stopPropagation();
                        removeLine(button_supprimer.id, table_body)
                    });

                    cell_number.innerText = number;
                    cell_ouvrage.innerText = titre.value;
                    cell_type.innerText = type_ouvrage.value;
                    cell_nb_exemplaire.innerText = nb_exemplaire.value;
                    cell_code.innerText = identifiant.value;

                    cell_editer.appendChild(button_editer);
                    cell_supprimer.appendChild(button_supprimer);
                    number++;

                    row.appendChild(cell_number);
                    row.appendChild(cell_code);
                    row.appendChild(cell_ouvrage);
                    row.appendChild(cell_type);
                    row.appendChild(cell_nb_exemplaire);
                    row.appendChild(cell_editer);
                    row.appendChild(cell_supprimer);

                    table_body.appendChild(row);
                    cleanInput();
                }
            });
            function removeLine(id, table_body){
                table_body.removeChild(table_body.children[id]);
            }

            function validate(){
                //console.log('validate');

                if (type_ouvrage.value==""){
                    type_ouvrage_error.hidden = false;
                    return false;
                } type_ouvrage_error.hidden = true;

                if (titre.value==""){
                    titre_error.hidden = false;
                    return false;
                } titre_error.hidden = true;

                if(! tileExist(titre.value, type_ouvrage.value)){
                   titre_not_found.hidden = false;
                   return false;
                } titre_not_found.hidden = true;

                if (nb_exemplaire.value <= 0){
                    nb_exemplaire_error.hidden = false;
                    return false;
                } nb_exemplaire_error.hidden = true;

                return true;
            }
            function cleanInput(){
                type_ouvrage.value = "";
                identifiant.value = "";
                titre.value = "";
                nb_exemplaire.value = "";
            }
            //set automatique title
            identifiant.addEventListener('keyup', function (e){
                if (type_ouvrage.value==""){
                    type_ouvrage_error.hidden = false;
                    identifiant.value = "";
                    return false;
                }
                titre.value = findTitreByID(identifiant.value, type_ouvrage.value);
            });

            //recherche
            let options_class_name = "ouvrages_titre";
            let id_select_attribute = "titre_ouvrage";
            let select_attribute = document.getElementById(id_select_attribute);

            titre.addEventListener("keyup", function () {
                search_object(titre.id, options_class_name);
            }, false);

            function search_object(id_searchbar, class_elts) {
                let input = document.getElementById(id_searchbar).value
                input = input.toLowerCase();
                let x = document.getElementsByClassName(class_elts);

                for (i = 0; i < x.length; i++) {
                    if (!x[i].innerHTML.toLowerCase().includes(input)) {
                        x[i].style.display = "none";
                    } else {
                        x[i].style.display = "list-item";
                    }
                }
            }


            function applySelected(id_elt, select_attribute) {
                let li = document.getElementById(id_elt);
                select_attribute.value=li.innerText;
            }

            let terminate_btn = document.getElementById('ajouter_donnee');
            let submit_btn = document.getElementById('action_approvisionnement');

            // format table before send
            function formatTableDataBeforeSend()
            {
                let table_body = document.getElementById('liste_approvisionnement').children[1];
                let stringData = "";
                let lines = table_body.children;
                for (let i = 0; i < lines.length; i++) {
                    submit_btn.disabled = false;
                    let line = lines[i].children;
                    $.ajax({
                        type:'get',
                        url:'{{URL::to('getCodeID')}}',
                        data:{'code_id':line[1].innerText, 'titre':line[2].innerText, 'type_code':line[3].innerText},

                        success:function (_data)
                        {
                            console.log(_data);
                            data.value += `${_data},${line[3].innerText},${line[4].innerText};`;
                        }
                    });
                }
            }

            terminate_btn.addEventListener('click', function (e){
                e.preventDefault();
                if(prenom_personnes.value == "Séléctionner prenom" || prenom_personnes.value == ""){
                    prenom_erreur.hidden = false;
                }else {
                    formatTableDataBeforeSend();
                }
            });

            function tileExist(titre, type_ouvrage){
                let existe = false;
                if (type_ouvrage=='livre_papier'){
                    for (let i = 0; i < livres_papier.length; i++) {
                        if(livres_papier[i]['titre']==titre){
                            existe = true;
                        }
                    }
                } else if (type_ouvrage=='document_audio_visuel'){
                    for (let i = 0; i < doc_av.length; i++) {
                        if(doc_av[i]['titre']==titre){
                            existe = true;
                        }
                    }
                }
                return existe;
            }
            function findTitreByID(identifant, type_ouvrage){
                let titre = "";
                if (type_ouvrage=='livre_papier'){
                    for (let i = 0; i < livres_papier.length; i++) {
                        if(livres_papier[i]['ISBN']==identifant){
                            titre = livres_papier[i]['titre'];
                        }
                    }
                } else if (type_ouvrage=='document_audio_visuel'){
                    for (let i = 0; i < doc_av.length; i++) {
                        if(doc_av[i]['ISAN']==identifant){
                            titre = doc_av[i]['titre'];
                        }
                    }
                }
                return titre;
            }
        </script>
    @stop
@st

