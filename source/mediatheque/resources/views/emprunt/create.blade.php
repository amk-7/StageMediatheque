@extends("layout.template.base")

@section("content")
    <div class="flex flex-col justify-center items-center m-auto">
        <form action="{{route('storeEmprunt')}}" method="post" class="bg-white p-12 mb-12 space-y-3">
            @csrf
           <div class="flex flex-col items-center justify-center">
               <h1 class="label_title" >Emprunt</h1>
               <h3 class="label_title_sub_title">Date {{ date('Y-m-d') }}</h3>
           </div>
            <fieldset class="fieldset_border" >
                <legend>Personnel</legend>
                <div class="flex flex-col">
                    <label for="nom" class="">Nom</label>
                    <select name="nom" id="nom_personnes" class="select_btn w-full"></select>
                </div>
                <div class="alert">
                    <p id="nom_erreur" hidden>Vous devez séléctionner le nom</p>
                </div>
                <div class="flex flex-col">
                    <label for="prenom">Prenom</label>
                    <select name="prenom" id="prenom_personnes" class="select_btn w-full">
                        <option>Séléctionner prénom</option>
                    </select>
                </div>
                <div class="alert">
                    <p id="prenom_erreur" hidden>Vous devez séléctionner le prenom</p>
                </div>
            </fieldset>
            <fieldset class="fieldset_border" >
                <legend>Abonné</legend>
                <div class="flex flex-col">
                    <label for="nom_abonnee">Nom</label>
                    <select name="nom_abonne" id="nom_abonnes" class="select_btn w-full"></select>
                </div>
                <div class="alert">
                    <p id="nom_abonne_erreur" hidden>Vous devez séléctionner le nom</p>
                </div>
                <div class="flex flex-col">
                    <label for="prenom_abonne">Prenom</label>
                    <select name="prenom_abonne" id="prenom_abonnes" class="select_btn w-full">
                        <option>Séléctionner prénom</option>
                    </select>
                </div>
                <div class="alert">
                    <p id="prenom_abonne_erreur" hidden>Vous devez séléctionner le prenom</p>
                </div>
                <div class="alert">
                    <p id="abonne_non_eligible" hidden>L'abonné a déjà des emprunts en cours</p>
                </div>
                <div class="alert">
                    <p id="nombre_emprunt" hidden>Vous avez atteint le nombre maximum d'emprunt</p>
                </div>
            </fieldset>

            <fieldset class="fieldset_border" >
                <legend>Ouvrage</legend>
                <div>
                    <div class="flex flex-col">
                        <label for="ouvrage_cote">Cote</label>
                        <input type="text" name="ouvrage_cote" id="ouvrage_cote" class="input"
                               placeholder="Saisire l'idendifiant la cote de l'ouvrage" autocomplete="off">
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
                        <input id="titre_ouvrage" type="text" name="titre" class="input disabled:opacity-10" disabled>
                        <input name="data" id="data" type="text" hidden>
                    </div>
                </div>
                <div>
                    <div class="flex flex-col">
                        <label for="etat_ouvrage">Etat ouvrage</label>
                        <select name="etat_ouvrage" id="etat_ouvrage" class="select_btn w-full">
                            <option selected>Séléctionner etat</option>
                            @for($i=4; $i>3; $i--)
                                <option value="{{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }}"> {{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }} </option>
                            @endfor
                        </select>
                    </div>
                    <div class="alert">
                        <p id="etat_ouvrage_erreur" hidden>Le champ etat ouvrage est requis.</p>
                    </div>
                </div>
            </fieldset>
            <fieldset class="fieldset_border" >
                <legend>Duree emprunt</legend>
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
                    <button name="ajouter_emprunt" id="ajouter_emprunt" class="button button_primary w-1/5 p-2">Ajouter</button>
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
            <!-- Overlay element -->
            <div id="overlay" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
            <div class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_editer">
                <div class="flex flex-col items-center space-y-4">
                    <div>
                        <label>Etat entree</label>
                        <select name="" id="etat_ouvrage_edite">
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
            <input type="submit" id="action_emprunter" name="action_emprunt" value="Emprunter" class="button button_primary w-full mt-3">
        </form>
    </div>
@stop
@section("js")
    <script type="text/javascript" async>

        let personnels = {!! $personnels !!};
        let abonnes = {!! $abonnes !!};
        let livres_papier = {!! $livre_papier !!};
        let doc_av = {!! $document_audio_visuel !!};
        console.log(abonnes);
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
        let overlay = document.getElementById('overlay');
        let div_modal = document.getElementById("modal_editer");

        //declarer une variable nbre d'emprunt
        let nombre_emprunt = 0;

        //let btn_modifier = document.getElementById('btn_modifier');

        let nom_abonne_erreur = document.getElementById('nom_abonne_erreur');
        let prenom_abonne_erreur = document.getElementById('prenom_abonne_erreur');
        let nom_erreur = document.getElementById('nom_erreur');
        let prenom_erreur = document.getElementById('prenom_erreur');
        let cote_erreur = document.getElementById('cote_ouvrage_erreur');
        let cote_no_trouve = document.getElementById('cote_ouvrage_not_found');
        let etat_ouvragae_erreur = document.getElementById('etat_ouvrage_erreur');
        let emprunts_erreur = document.getElementById('emprunt_erreur');
        let non_eligble_erreur = document.getElementById('abonne_non_eligible');
        let nombre_emprunt_erreur = document.getElementById('nombre_emprunt');
        let cote_ouvrage_exist = document.getElementById('cote_ouvrage_exist');

        console.log(nombre_emprunt_erreur);

        setLiteOptions(nom_personnes, personnels);
        setLiteOptions(nom_abonnes, abonnes);
        cleanALl();

        let numero_ligne_edite = -1;

        btn_modifier.addEventListener('click', function (e) {
            stopPropagation(e);
            modifierEtatOuvrage();
        });

        cote_ouvrage.addEventListener('keyup', function (e) {
            rechercherTitreParCote();
        });

        nom_personnes.addEventListener('change', function (e) {
            mettreListePrenomParNom(prenom_personnes, nom_personnes.value, personnels);
        });

        nom_abonnes.addEventListener('change', function (e) {
            mettreListePrenomParNom(prenom_abonnes, nom_abonnes.value, abonnes);
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
                    console.log(option.value)
                    option.innerText = liste[i]['prenom'];
                    balise.appendChild(option);
                }
            }
        }

        function stopPropagation() {
            event.preventDefault();
            event.stopPropagation();
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
            console.log("::::::::Add:::::::::");
            if(validateUser()){
                console.log("::::::::Validate::::::::");
                let id_abonne = prenom_abonnes.value;
                console.log(verfierSiAbonneEstEligible(id_abonne));
                if(verfierSiAbonneEstEligible(id_abonne)=="false"){
                    //console.log("abonne non eligible");
                    non_eligble_erreur.hidden = false;
                    stopPropagation();
                    return;
                }
            }
            /*if(verifierNombreMaxEmprunt(prenom_abonnes.value)){
                    console.log("AAAAAAAAAAAAAAAA");
                    nombre_emprunt_erreur.hidden = false;
                    stopPropagation();
                    return;
                }*/
            non_eligble_erreur.hidden = true;
            //nombre_emprunt_erreur.hidden = true;

            //console.log("Salut");
            e.preventDefault();
            //return;
            if (validate()) {
                console.log(verifierSiOuvrageExisteDansEmprunt(cote_ouvrage.value))
                if(verifierSiOuvrageExisteDansEmprunt(cote_ouvrage.value)){
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
                cell_ouvrage.innerText = titre.value;
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
            }
        });

        function editerLigne(numero_ligne) {
            div_modal.classList.remove('hidden');
            overlay.classList.remove('hidden');
            numero_ligne_edite = numero_ligne;
        }

        function modifierEtatOuvrage() {
            //console.log("modification.... "+numero_ligne_edite);
            let table_body = document.getElementById('liste_emprunt').children[1];
            let etat_ouvrage_edite = document.getElementById('etat_ouvrage_edite');
            let lines = table_body.children;
            for (let i = 0; i < lines.length; i++) {
                if (i === parseInt(numero_ligne_edite)) {
                    let line = lines[i].children;
                    line[3].innerText = etat_ouvrage_edite.value;
                    let div_modal = document.getElementById("modal_editer");
                    div_modal.classList.add('hidden');
                    overlay.classList.add('hidden');
                    etat_ouvrage_edite.value = "Séléctionner etat";
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

            if (etat_ouvrage.value === "" || etat_ouvrage.value === "Séléctionner etat") {
                etat_ouvragae_erreur.hidden = false;
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
            nom_personnes.value = "Séléctionner nom";
            prenom_personnes.value = "Séléctionner prénom";
            nom_abonnes.value = "Séléctionner nom";
            prenom_abonnes.value = "Séléctionner prénom";
            donne.value = "";
        }

        function rechercherTitreParCote() {
            console.log("recherche....");
            let cote = cote_ouvrage.value;
            if (cote.substring(0, 2) === "LP") {
                for (let i = 0; i < livres_papier.length; i++) {
                    if (livres_papier[i]['cote'] === cote) {
                        titre.value = livres_papier[i]['titre'];
                        return;
                    }
                }
            } else if (cote.substring(0, 2) === "DA") {
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

        function getType(str) {
            if (str.substring(0, 2) === "LP") {
                return "livre_papier";
            }
            return "document_av";
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
        });

        function validateUser(){
            if (nom_personnes.value === "Séléctionner nom" || nom_personnes.value === "") {
                nom_erreur.hidden = false;
                stopPropagation();
                return false;
            }
            nom_erreur.hidden = true;

            if (prenom_personnes.value === "Séléctionner prénom" || prenom_personnes.value === "") {
                prenom_erreur.hidden = false;
                stopPropagation();
                return false;
            }
            prenom_erreur.hidden = true;

            if (nom_abonnes.value === "Séléctionner nom" || nom_abonnes.value === "") {
                nom_abonne_erreur.hidden = false;
                stopPropagation();
                return false;
            }
            nom_abonne_erreur.hidden = true;

            if (prenom_abonnes.value === "Séléctionner prénom" || prenom_abonnes.value === "") {
                prenom_abonne_erreur.hidden = false;
                stopPropagation();
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
            //abonnes.forEach(element => console.log(element));
            for(let i = 0; i < abonnes.length; i++)
            {
                //console.log(abonnes[i]['id']);
                if(abonnes[i]['id'] == id_abonne)
                {
                    console.log(abonnes[i]['estEligible']);
                    return abonnes[i]['estEligible'];
                }

            }
            //console.log(abonnes);

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

    </script>
@stop


