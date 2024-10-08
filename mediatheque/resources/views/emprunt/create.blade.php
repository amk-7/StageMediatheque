@extends("layouts.app")
@section("content")
    <div class="flex flex-col justify-center items-center m-auto">
        <form action="{{route('emprunts.store')}}" method="post" class="bg-white p-12 mb-12 space-y-3 border">
            @csrf
           <div class="flex flex-col items-center justify-center">
               <h1 class="label_title" >Emprunt</h1>
               <h3 class="label_title_sub_title">Date {{ date('Y-m-d') }}</h3>
           </div>
            <fieldset class="fieldset_border" >
                <legend>Abonné</legend>
                <div class="flex space-x-3">
                    <div class="flex flex-col w-full">
                        <label for="nom_abonnee">Nom</label>
                        <select name="nom_abonne" id="nom_abonnes" class="select_btn w-full"></select>
                    </div>
                    <div class="flex flex-col w-full">
                        <label for="prenom_abonne">Prenom</label>
                        <select name="prenom_abonne" id="prenom_abonnes" class="select_btn w-full">
                            <option>Séléctionner prénom</option>
                        </select>
                    </div>
                </div>
                <div class="alert">
                    <p id="nom_abonne_erreur" hidden>Vous devez séléctionner le nom</p>
                </div>
                <div class="alert">
                    <p id="prenom_abonne_erreur" hidden>Vous devez séléctionner le prenom</p>
                </div>
                <div class="alert">
                    <p id="abonne_non_eligible" hidden>L'abonné a déjà des emprunts en cours</p>
                    <p id="abonne_pas_abonnement" hidden>L'abonné n'a pas payer un abonnement</p>
                </div>
                <div class="alert">
                    <p id="abonne_pas_abonnement" hidden>L'abonné n'a pas d'abonnement en cours</p>
                </div>
                <div class="alert">
                    <p id="nombre_emprunt" hidden>Vous avez atteint le nombre maximum d'emprunt</p>
                </div>
            </fieldset>

            <fieldset class="fieldset_border space-y-3" >
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
                        <label for="etat_ouvrage">Etat ouvrage</label>
                        <select name="etat_ouvrage" id="etat_ouvrage" class="select_btn w-full">
                            <option selected>Séléctionner etat</option>
                            @for($i=4; $i>3; $i--)
                                <option value="{{ \App\Http\Controllers\Controller::demanderEtat()[$i] }}"> {{ \App\Http\Controllers\Controller::demanderEtat()[$i] }} </option>
                            @endfor
                        </select>
                    </div>
                    <div class="alert">
                        <p id="etat_ouvrage_erreur" hidden>Le champ etat ouvrage est requis.</p>
                    </div>
                </div>
            </fieldset>
            <fieldset class="fieldset_border" >
                <legend>Duree</legend>
                <div class="flex flex-col">
                    <label for="duree_emprunt">Duree Emprunt</label>
                    <select name="duree_emprunt" id="duree_emprunt" class="select_btn">
                        <option>Sélectionner durée</option>
                        @for($i=1; $i<=4; $i++)
                            <option value="{{$i}}" {{ $i == 2 ? "selected" : "" }} > {{$i}} Semaines</option>
                        @endfor
                    </select>
                </div>
            </fieldset>
            <div>
                <div class="flex space-x-8">
                    <button name="ajouter_emprunt" id="ajouter_emprunt" class="button button_primary w-2/5 p-2">Ajouter</button>
                </div>
                <div class="alert">
                    <p id="emprunt_erreur" hidden>Veuillez ajouter cet d'ouvrage.</p>
                </div>
            </div>
           <fieldset class="fieldset_border flex flex-col items-center space-y-4">
               <h3 class="label_title_sub_title">Liste des Emprunts</h3>
               <table border="1" id="liste_emprunt" class="fieldset_border">
                   <thead class="fieldset_border" >
                   <tr class="fieldset_border" >
                       <th class="fieldset_border" >N°</th>
                       <th class="fieldset_border" >Cote</th>
                       <th class="fieldset_border" >Titre ouvrage</th>
                       <th class="fieldset_border" >Etat de l'ouvrage</th>
                       <th class="fieldset_border" >Supprimer</th>
                   </tr>
                   </thead>
                   <tbody class="fieldset_border" ></tbody>
               </table>
           </fieldset>
            <input type="submit" id="action_emprunter" name="action_emprunt" value="Emprunter" class="button button_primary w-full mt-3">
        </form>
    </div>
    <!-- Overlay element -->
    <div id="overlay" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60" style="z-index:1000"></div>
    <div style="z-index: 1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_editer">
        <div class="flex flex-col items-center space-y-4">
            <div class="flex flex-col justify-center items-center m-auto">
                <div class="flex flex-col items-center space-y-3">
                    <div class="w-full">
                        <div id="reader"></div>
                    </div>
                    <button name="quit" id="quit" class="button button_primary w-2/5 p-2">Quitter</button>
                    <div class="info">
                        <p id="qrscan" hidden>QR code scanner.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section("js")
    <script src="https://reeteshghimire.com.np/wp-content/uploads/2021/05/html5-qrcode.min_.js"></script>
    <!--script src="{ { url('js/html5-qrcode/html5-qrcode.min.js') }}"></script-->
    <script type="text/javaScript">
        $(document).ready(function() {
            $('#titre_ouvrage').select2();
        });
    </script>
    <script type="text/javaScript" async>
        let abonnes = {!! $abonnes !!};
        let ouvrages = {!! $ouvrages !!};
        //console.log(ouvrages);
        let nom_abonnes = document.getElementById('nom_abonnes');
        let prenom_abonnes = document.getElementById('prenom_abonnes');
        let cote_ouvrage = document.getElementById('ouvrage_cote');
        let titre = document.getElementById('titre_ouvrage');
        let etat_ouvrage = document.getElementById('etat_ouvrage');
        let donne = document.getElementById('data');
        let btn_ajouter = document.getElementById('ajouter_emprunt');
        let submit_btn = document.getElementById('action_emprunter');
        let duree_emprunt = document.getElementById('duree_emprunt');
        let overlay = document.getElementById('overlay');
        let div_modal = document.getElementById("modal_editer");
        let button_scan = document.getElementById("scan_qrcode");
        let button_scan_quit = document.getElementById("quit");

        let nombre_emprunt = 0;
        let qrsacn = document.getElementById('qrscan');

        let nom_abonne_erreur = document.getElementById('nom_abonne_erreur');
        let prenom_abonne_erreur = document.getElementById('prenom_abonne_erreur');
        let cote_erreur = document.getElementById('cote_ouvrage_erreur');
        let cote_no_trouve = document.getElementById('cote_ouvrage_not_found');
        let etat_ouvragae_erreur = document.getElementById('etat_ouvrage_erreur');
        let emprunts_erreur = document.getElementById('emprunt_erreur');
        let non_eligble_erreur = document.getElementById('abonne_non_eligible');
        let nombre_emprunt_erreur = document.getElementById('nombre_emprunt');
        let cote_ouvrage_exist = document.getElementById('scan_qrcode');
        let abonne_pas_abonnement = document.getElementById('abonne_pas_abonnement');

        function cleanErrorMessages(){
            nom_abonne_erreur.hidden = true;
            prenom_abonne_erreur.hidden = true;
            cote_erreur.hidden = true;
            cote_no_trouve.hidden = true;
            etat_ouvragae_erreur.hidden = true;
            emprunts_erreur.hidden = true;
            non_eligble_erreur.hidden = true;
            nombre_emprunt_erreur.hidden = true;
            cote_ouvrage_exist.hidden = true;
            abonne_pas_abonnement.hidden = true;
        }

        setLiteOptions(nom_abonnes, abonnes);
        nom_abonnes.addEventListener('change', function (e) {
            mettreListePrenomParNom(prenom_abonnes, nom_abonnes.value, abonnes);
        });

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

        btn_ajouter.addEventListener('click', function addApprovisionnement() {
            stopPropagation();
            cleanErrorMessages();
            if(validateUser()){
                let id_abonne = prenom_abonnes.value;
                if (verifierSiAbonnEstRegistre(id_abonne) == "false"){
                    abonne_pas_abonnement.hidden = false;
                    return;
                }
                if(verfierSiAbonneEstEligible(id_abonne)=="false"){
                    non_eligble_erreur.hidden = false;
                    return;
                }

            }
            abonne_pas_abonnement.hidden = true;
            non_eligble_erreur.hidden = true;
            console.log(validate());
            if (validate()) {
                let cote = cote_ouvrage.value;
                if(verifierSiOuvrageExisteDansEmprunt(cote)){
                    cote_ouvrage_exist.hidden = false;
                    return;
                }
                cote_ouvrage_exist.hidden = true;

                //Verifier si le nombre d'emprunt n'est pas inferieur à 5 là on sort
                if (nombre_emprunt >= 2) {
                    nombre_emprunt_erreur.hidden = false;
                    stopPropagation();
                    return ;
                }

                nombre_emprunt_erreur.hidden = true;
                let table_body = document.getElementById('liste_emprunt').children[1];
                let row = document.createElement('tr');
                let cell_number = document.createElement('td');
                let cell_code = document.createElement('td');
                let cell_ouvrage = document.createElement('td');
                let cell_etat_ouvrage = document.createElement('td');
                let cell_supprimer = document.createElement('td');
                let button_supprimer = document.createElement('button');

                button_supprimer.innerText = "Supprimer";
                button_supprimer.id = number - 1;
                button_supprimer.classList = "button button_delete";

                button_supprimer.addEventListener('click', function (e) {
                    stopPropagation(e);
                    removeLine(button_supprimer.id, table_body)
                });

                cell_number.innerText = number;
                cell_ouvrage.innerText = $('#titre_ouvrage').find(`option[value="${titre.value}"]`).text();
                cell_etat_ouvrage.innerText = etat_ouvrage.value;
                cell_code.innerText = cote_ouvrage.value;

                cell_supprimer.appendChild(button_supprimer);
                number++;
                cell_number.classList = "fieldset_border";
                cell_code.classList = "fieldset_border";
                cell_ouvrage.classList = "fieldset_border";
                cell_etat_ouvrage.classList = "fieldset_border";
                cell_supprimer.classList = "fieldset_border";

                row.appendChild(cell_number);
                row.appendChild(cell_code);
                row.appendChild(cell_ouvrage);
                row.appendChild(cell_etat_ouvrage);
                row.appendChild(cell_supprimer);

                table_body.appendChild(row);
                cleanInput();

                //incrementer le nombre d'emprunt
                nombre_emprunt = nombre_emprunt + 1;
                button_scan.hidden = false;
            }
        });


        function removeLine(id, table_body) {
            table_body.removeChild(table_body.children[id]);
        }

        function validate() {
            button_scan.hidden = false;
            if (cote_ouvrage.value === "") {
                cote_erreur.hidden = false;
                console.log("error: cote_ouvrage");
                return false;
            }

            if (titre.value === "Aucun ouvrage trouvé") {
                cote_no_trouve.hidden = false;
                console.log("error: titre");
                return false;
            }

            if (etat_ouvrage.value === "" || etat_ouvrage.value === "Séléctionner etat") {
                etat_ouvragae_erreur.hidden = false;
                console.log("error: etat_ouvragae_erreur");
                return false;
            }

            return true;
        }

        function cleanInput() {
            cote_ouvrage.value = "";
            titre.value = "";
            etat_ouvrage.value = "Séléctionner etat";
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

        function formatTableDataBeforeSend() {
            let table_body = document.getElementById('liste_emprunt').children[1];
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
            cleanErrorMessages();
            if (! validerFormulaire(e)){
                stopPropagation();

                return ;
            }
            formatTableDataBeforeSend();
            if (donne.value === "") {
                stopPropagation();
            }
        });

        function validateUser(){
            button_scan.hidden = false;
            if (nom_abonnes.value === "Séléctionner nom" || nom_abonnes.value === "") {
                nom_abonne_erreur.hidden = false;
                return false;
            }
            nom_abonne_erreur.hidden = true;

            if (prenom_abonnes.value === "Séléctionner prénom" || prenom_abonnes.value === "") {
                prenom_abonne_erreur.hidden = false;
                return false;
            }
            prenom_abonne_erreur.hidden = true;

            return true ;
        }

        function validerFormulaire(e) {
            if(! validateUser()){
                return false;
            }
            if (cote_ouvrage.value !== "" || etat_ouvrage.value !== "Séléctionner etat") {
                emprunts_erreur.hidden = false;
                stopPropagation();
                return false;
            }
            return true;
        }


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

        function verifierSiAbonnEstRegistre(id_abonne)
        {
            for(let i = 0; i < abonnes.length; i++)
            {
                if(abonnes[i]['id'] == id_abonne)
                {
                    return abonnes[i]['pas_abonnement'];
                }
            }
        }

        verifierNombreMaxEmprunt(1);
        function verifierNombreMaxEmprunt(id_abonne) {
            for(let i = 0; i < abonnes.length; i++)
            {
                if(abonnes[i]['id'] == id_abonne)
                {
                    if(abonnes[i]['nombre_emprunt'] >= 5)
                    {
                        return false;
                    }
                    return true;
                }
            }
        }

        function verifierSiOuvrageExisteDansEmprunt(cote)
        {
            let table_body = document.getElementById('liste_emprunt').children[1];
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
            qrsacn.hidden = true;
        });
        function onScanError(errorMessage) {
            //handle scan error
        }
        cote_ouvrage.addEventListener('keyup', function (e) {
            console.log("keyup");
            $('#titre_ouvrage').val(cote_ouvrage.value);
            $('#titre_ouvrage').trigger('change');
        });


        function onScanSuccess(qrCodeMessage) {
            cote_ouvrage.value = qrCodeMessage;
            $('#titre_ouvrage').val(cote_ouvrage.value);
            qrsacn.hidden = false;
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanError);

    </script>
@stop


