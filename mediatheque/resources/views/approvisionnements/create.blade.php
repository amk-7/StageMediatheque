@extends("layouts.app")
@section("content")
    <div class="flex flex-col justify-center items-center m-auto">
        <form action="{{route('approvisionnements.store')}}" method="post" class="bg-white p-12 mb-12 space-y-3">
            @csrf
            <div class="flex flex-col items-center justify-center">
                <h1 class="label_title" >Approvisionnement</h1>
                <h3 class="label_title_sub_title">Date {{ date('Y-m-d') }}</h3>
            </div>

            <fieldset class="fieldset_border" >
                <legend>Ouvrage</legend>
                <div hidden>
                    <div class="flex flex-col">
                        <label for="ouvrage_cote">Cote</label>
                        <div class="flex space-x-8">
                            <button name="scan_qrcode" id="scan_qrcode" class="button button_primary p-2 w-1/3">Scanner</button>
                            <input type="text" name="ouvrage_cote" id="ouvrage_cote" class="input w-2/3"
                                   placeholder="Saisire l'idendifiant la cote de l'ouvrage" autocomplete="off">
                        </div>
                    </div>
                    <div class="alert">
                        <p id="cote_ouvrage_erreur" hidden>Le champ cote doit être renseigner</p>
                        <p id="cote_ouvrage_not_found" hidden>Cet ouvrage n'existe pas</p>
                        <p id="cote_ouvrage_exist" hidden>Cet ouvrage existe déjà dans cet emprunt</p>
                    </div>
                </div>
                <div>
                    <div class="flex flex-col">
                        <label for="titre_ouvrage">Titre</label>
                        <div class="select_btn w-full">
                            <select name="titre" id="titre_ouvrage" class="w-full">
                                <option value="">Selectionner</option>
                                @php
                                    $ouvrages2 = json_decode($ouvrages);
                                @endphp
                                @foreach($ouvrages2 as $ouvrage)
                                    <option value="{{  $ouvrage->id_ouvrage }}">{{  $ouvrage->titre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input name="data" id="data" type="text" hidden>
                    </div>
                </div>
                <div>
                    <div class="flex flex-col">
                        <label for="nombre_examplaire">Nombre d'examplaire</label>
                        <input id="nombre_examplaire" type="number" name="nombre_examplaire" class="input" value="0">
                    </div>
                </div>
            </fieldset>
            <div>
                <div class="flex space-x-8">
                    <button name="ajouter_ouvrage" id="ajouter_ouvrage" class="button button_primary w-2/5 p-2">Ajouter</button>
                </div>
                <div class="alert">
                    <p id="approvisionement_erreur" hidden>Veuillez ajouter cet d'ouvrage.</p>
                </div>
            </div>
            <fieldset class="fieldset_border flex flex-col items-center space-y-4">
                <h3 class="label_title_sub_title">Liste des approvisionnements</h3>
                <table border="1" id="liste_ouvrages" class="fieldset_border">
                    <thead class="fieldset_border" >
                    <tr class="fieldset_border" >
                        <th class="fieldset_border" >N°</th>
                        <th class="fieldset_border" >Cote</th>
                        <th class="fieldset_border" >Titre ouvrage</th>
                        <th class="fieldset_border" >Nombre d'examplaire</th>
                        <th class="fieldset_border" >Supprimer</th>
                    </tr>
                    </thead>
                    <tbody class="fieldset_border" ></tbody>
                </table>
            </fieldset>
            <!-- Overlay element -->
            <div id="overlay" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
            <div class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_editer">
                <div class="flex flex-col items-center space-y-4">
                    <div class="flex flex-col justify-center items-center m-auto">
                        <div class="flex flex-col">
                            <div class="w-full">
                                <div id="reader"></div>
                            </div>
                            <button name="quit" id="quit" class="button button_primary w-2/5 p-2">Quitter</button>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" id="action_approvisionner" name="action_approvisionner" value="Approvisionner" class="button button_primary w-full mt-3">
        </form>
    </div>
@stop
@section("js")
    <script src="https://reeteshghimire.com.np/wp-content/uploads/2021/05/html5-qrcode.min_.js"></script>
    <script type="text/javaScript">
        $(document).ready(function() {
            $('#titre_ouvrage').select2();
        });
    </script>
    <script type="text/javascript" async>

        let livres_papier = {!! $ouvrages !!};

        let cote_ouvrage = document.getElementById('ouvrage_cote');
        let titre = document.getElementById('titre_ouvrage');
        let nombre_examplaire = document.getElementById('nombre_examplaire');
        let donne = document.getElementById('data');
        let btn_ajouter = document.getElementById('ajouter_ouvrage');
        let submit_btn = document.getElementById('action_approvisionner');
        let overlay = document.getElementById('overlay');
        let div_modal = document.getElementById("modal_editer");
        let button_scan = document.getElementById("scan_qrcode");
        let button_scan_quit = document.getElementById("quit");

        let nombre_emprunt = 0;

        let cote_erreur = document.getElementById('cote_ouvrage_erreur');
        let cote_no_trouve = document.getElementById('cote_ouvrage_not_found');
        let approvisionements_erreur = document.getElementById('approvisionement_erreur');
        let cote_ouvrage_exist = document.getElementById('scan_qrcode');

        function ouvrageExiste(cote){
            for (let i = 0; i < livres_papier.length; i++){
                if (livres_papier[i]['cote'] === cote){
                    return true;
                }
            }
            return false;
        }

        $('#titre_ouvrage').on('select2:select', function (e) {
            cote_ouvrage.value = titre.value;
        });

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
                    option.innerText = liste[i]['prenom'];
                    balise.appendChild(option);
                }
            }
        }

        function stopPropagation() {
            event.stopPropagation();
            event.preventDefault();
        }

        function setLiteOptions(elt, liste) {
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

        btn_ajouter.addEventListener('click', function addApprovisionnement(e) {
            stopPropagation();
            if (validate()) {
                let cote = cote_ouvrage.value;

                if(verifierSiOuvrageExisteDansEmprunt(cote)){
                    cote_ouvrage_exist.hidden = false;
                    return;
                }
                cote_ouvrage_exist.hidden = true;

                let table_body = document.getElementById('liste_ouvrages').children[1];
                let row = document.createElement('tr');
                let cell_number = document.createElement('td');
                let cell_code = document.createElement('td');
                let cell_ouvrage = document.createElement('td');
                let cell_nombre_examplaire = document.createElement('td');
                let cell_supprimer = document.createElement('td');
                let button_supprimer = document.createElement('button');

                button_supprimer.innerText = "Supprimer";
                button_supprimer.id = number - 1;
                button_supprimer.classList = "button button_delete";

                button_supprimer.addEventListener('click', function (e) {
                    stopPropagation(e);
                    removeLine(button_supprimer.id, table_body)
                });
                cell_nombre_examplaire.innerText = nombre_examplaire.value;
                cell_number.innerText = number;
                cell_ouvrage.innerText =  $('#titre_ouvrage').find(`option[value="${titre.value}"]`).text();
                cell_code.innerText = cote_ouvrage.value;

                cell_supprimer.appendChild(button_supprimer);
                number++;
                cell_number.classList = "fieldset_border";
                cell_code.classList = "fieldset_border";
                cell_ouvrage.classList = "fieldset_border";
                cell_supprimer.classList = "fieldset_border";

                row.appendChild(cell_number);
                row.appendChild(cell_code);
                row.appendChild(cell_ouvrage);
                row.append(cell_nombre_examplaire);
                row.appendChild(cell_supprimer);

                table_body.appendChild(row);
                nombre_emprunt = nombre_emprunt + 1;
                //incrementer le nombre d'emprunt
                button_scan.hidden = false;
                cleanInput();
            }
        });


        function removeLine(id, table_body) {
            table_body.removeChild(table_body.children[id]);
        }

        function validate() {
            if (cote_ouvrage.value === "") {
                cote_erreur.hidden = false;
                return false;
            }

            if (nombre_examplaire.value === "0"){
                return false;
            }

            if (titre.value === "Aucun ouvrage trouvé") {
                cote_no_trouve.hidden = false;
                return false;
            }

            return true;
        }

        function cleanInput() {
            cote_ouvrage.value = "";
            titre.value = "";
        }

        function cleanALl() {
            cleanInput();
            nom_abonnes.value = "Séléctionner nom";
            prenom_abonnes.value = "Séléctionner prénom";
            donne.value = "";
        }

        function rechercherTitreParCote() {
            let cote = cote_ouvrage.value;
            for (let i = 0; i < ouvrages.length; i++) {
                if (ouvrages[i]['id_ouvrage'] === parseInt(cote)) {
                    titre.value = ouvrages[i]['titre'];
                    return;
                }
            }

            // titre.value = "Aucun ouvrage trouvé";
        }

        // format table before send
        function formatTableDataBeforeSend() {
            let table_body = document.getElementById('liste_ouvrages').children[1];
            let lines = table_body.children;
            for (let i = 0; i < lines.length; i++) {
                let line = lines[i].children;
                donne.value += `${dernierCarracter(line[1].innerText)},${line[3].innerText};`;
            }
        }

        function dernierCarracter(str) {
            return str.substring(str.length - 6, str.length);
        }

        submit_btn.addEventListener('click', function (e){
            if (! validerFormulaire(e)){
                stopPropagation();
                return ;
            }
            formatTableDataBeforeSend();
            if (donne.value === "") {
                stopPropagation();
            }
            //console.log(donne.value);
            //stopPropagation()
        });

        function validerFormulaire(e) {
            if (cote_ouvrage.value !== "") {
                approvisionements_erreur.hidden = false;
                stopPropagation();
                return false;
            }
            return true;
        }

        /*function verifierEmpruntEnCours(id_abonne) {
            let emprunts = [];
            for (let i = 0; i < emprunts_en_cours.length; i++) {
                if (emprunts_en_cours[i]['id_abonne'] === id_abonne) {
                    emprunts.push(emprunts_en_cours[i]);
                }
            }
            return emprunts;
        }*/
        //verfierSiAbonneEstEligible(2);
        function verfierSiAbonneEstEligible(id_abonne)
        {
            for(let i = 0; i < abonnes.length; i++)
            {
                if(abonnes[i]['id'] == id_abonne)
                {
                    return abonnes[i]['estEligible'];
                }
            }
        }

        function verifierSiOuvrageExisteDansEmprunt(cote)
        {
            let table_body = document.getElementById('liste_ouvrages').children[1];
            let lines = table_body.children;
            for (let i = 0; i < lines.length; i++) {
                if (lines[i].children[1].innerText == cote)
                {
                    return true;
                }
            }
            return false;
        }

        button_scan.addEventListener("click", function (){
            stopPropagation();
            div_modal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        });

        button_scan_quit.addEventListener("click", function (){
            stopPropagation();
            div_modal.classList.add('hidden');
            overlay.classList.add('hidden');
        });

        function onScanSuccess(qrCodeMessage) {
            cote_ouvrage.value = qrCodeMessage;
            rechercherTitreParCote();
        }

        function onScanError(errorMessage) {
            //handle scan error
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess, onScanError);

        cote_ouvrage.addEventListener('keyup', function (e) {
            rechercherTitreParCote();
        });

    </script>
@stop


