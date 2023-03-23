@extends("layout.template.base")
@section("content")
    <div class="flex flex-col justify-center items-center m-auto">
        <div class="bg-white p-12 mb-12 space-y-3">
            <form action="{{route('enregistrementActivite', $abonne)}}" method="post">
                @csrf
                <input hidden="" type="text" id="activite" name="activite" value="">
                <div class="flex flex-col items-center justify-center">
                    <h1 class="label_title" >Abonné : <span>{{ $abonne->utilisateur->userFullName }}</span></h1>
                    <h3 class="label_title_sub_title">Date {{ date('Y-m-d') }}</h3>
                </div>
                <fieldset class="fieldset_border" >
                    <legend>Ouvrage</legend>
                    <div>
                        <div class="flex flex-col">
                            <label for="ouvrage_cote">Cote</label>
                            <div class="flex space-x-8">
                                <button type="button" name="scan_qrcode" id="scan_qrcode" class="button button_primary p-2 w-1/3">Scanner</button>
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
                            <label for="titre_ouvrage">Titres</label>
                            <textarea id="titres_ouvrages" type="text" name="titres" class="input">
                            </textarea>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-col">
                            <label for="titre_ouvrage">Sugestions</label>
                            <textarea type="text" name="sugestion" class="input" id="sugestions">
                            </textarea>
                        </div>
                    </div>
                </fieldset>
                <div>
                    <div class="flex justify-between">
                        <input type="submit" id="action_emprunter" name="enregister" value="Enregistrer" class="button button_primary mt-3" onclick="(function(){
                        document.getElementById('editer').value = '';
                    })();">
                        <a href="{{ route('listeAbonnes') }}">
                            <input type="button" id="action_quitter" name="quitter" value="Quitter" class="button button_delete mt-3">
                        </a>
                    </div>
                    <div class="alert">
                        <p id="emprunt_erreur" hidden>Veuillez ajouter cet d'ouvrage.</p>
                    </div>
                </div>
            </form>
            <fieldset class="fieldset_border flex flex-col items-center space-y-4">
                <h3 class="label_title_sub_title">Liste des ouvrages lue</h3>
                <table border="1" id="liste_emprunt" class="fieldset_border">
                    <thead class="fieldset_border" >
                    <tr class="fieldset_border" >
                        <th class="fieldset_border" >N°</th>
                        <th class="fieldset_border" >Titres ouvrages</th>
                        <th class="fieldset_border" >Sugestions</th>
                        <th class="fieldset_border" >Editer</th>
                        <!--th class="fieldset_border" hidden="">Supprimer</th-->
                    </tr>
                    </thead>
                    <tbody class="fieldset_border" >
                    @foreach($activitys as $activity)
                        <tr>
                            <td class="fieldset_border">{{ $activity->id_activite }}</td>
                            <td class="fieldset_border w-3">{{ $activity->ouvrages }}</td>
                            <td class="fieldset_border w-3">{{ $activity->sugestions }}</td>
                            <td class="fieldset_border">
                                <form method="GET" action="{{route('enregistrementActivite', $abonne)}}">
                                    <input hidden="" type="text" name="id_activite" value="{{ $activity->id_activite }}">
                                    <button class="button button_primary" type="Submit" name="editer" value="Editer">Editer</button>
                                </form>
                            </td>
                            <!--td class="fieldset_border" hidden="">
                                <form method="POST" action="">
                                    @ csrf
                                    @ method("DELETE")
                                    <button onclick="activeModal({ { $activity->id_activite }})" class="button button_delete" type="Submit">Supprimer</button>
                                </form>
                            </td-->
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </fieldset>
        </div>
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
    <!-- Overlay element -->
    <div style="z-index:1000" id="overlay_suppression" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
    <div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_supprimer">
        <div class="flex flex-col items-center space-y-4">
            <div id="id_message" class="text-center">
                <p>Voulez vous vraiment supprimer cette sugession ?</p>
            </div>
            <div class="flex flex-row space-x-8">
                <button id="btn_annuler" class="button button_show">Annuler</button>
                <form id="form_delete_confirm" action="{{route('enregistrementActivite', $abonne)}}" method="post">
                    @csrf
                    <input hidden="" type="text" name="id_activite" value="{{ $activity->id_activite }}">
                    <input type="submit" id="supprimer_ouvrage_confirm" name="supprimer" value="Supprimer" class="button button_delete">
                </form>
            </div>
        </div>
    </div>
@stop
@section("js")
    <script src="https://reeteshghimire.com.np/wp-content/uploads/2021/05/html5-qrcode.min_.js"></script>
    <!--script src="{ { url('js/html5-qrcode/html5-qrcode.min.js') }}"></script-->
    <script type="text/javascript" async>
        let ouvrages_edit = "{!! $activite_edit->ouvrages ?? '' !!}";
        let sugestions_edit = "{!! $activite_edit->sugestions ?? '' !!}";

        let livres_papier = {!! $livre_papier !!};

        let titre = document.getElementById('titres_ouvrages');
        titre.value = ouvrages_edit+";";
        let sugestions = document.getElementById('sugestions');
        sugestions.value = sugestions_edit;
        let cote_ouvrage = document.getElementById('ouvrage_cote');

        let activite_id = document.getElementById('activite');
        activite_id.value = "{!! $activite_edit->id_activite ?? '' !!}"

        let overlay = document.getElementById('overlay');
        let div_modal = document.getElementById("modal_editer");
        let button_scan = document.getElementById("scan_qrcode");
        let button_scan_quit = document.getElementById("quit");
        let qrsacn = document.getElementById('qrscan');

        cote_ouvrage.addEventListener('keyup', function (e) {
            rechercherTitreParCote();
        });

        let div_modal_supprimer = document.getElementById("modal_supprimer");
        let form_confirm = document.getElementById("form_delete_confirm");
        let btn_supprimer_ouvrage_confirm = document.getElementById("supprimer_ouvrage_confirm");
        let btn_annuler = document.getElementById("btn_annuler");
        let overlay_delete = document.getElementById("overlay_suppression");

        function activeModal(id){
            stopPropagation();
            div_modal_supprimer.classList.remove("hidden");
            overlay_delete.classList.remove('hidden');
        }

        btn_annuler.addEventListener('click', function (){
            stopPropagation();
            div_modal_supprimer.classList.add("hidden");
            overlay_delete.classList.add('hidden');
        });

        function rechercherTitreParCote() {
            let cote = cote_ouvrage.value;
            if (cote.substring(0, 2) === "LP") {
                for (let i = 0; i < livres_papier.length; i++) {
                    if (livres_papier[i]['cote'] === cote) {
                        titre.value += livres_papier[i]['titre']+";";
                        return;
                    }
                }
            } else if (cote.substring(0, 2) === "DA") {
                for (let i = 0; i < doc_av.length; i++) {
                    if (doc_av[i]['cote'] === cote) {
                        titre.value += doc_av[i]['titre']+";";
                        return;
                    }
                }
            }
        }

        function ouvrageExiste(cote){
            for (let i = 0; i < livres_papier.length; i++){
                if (livres_papier[i]['cote'] === cote){
                    return true;
                }
            }
            return false;
        }

        function stopPropagation() {
            event.stopPropagation();
            event.preventDefault();
        }

        button_scan.addEventListener("click", function (){
            stopPropagation();
            div_modal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        });

        button_scan_quit.addEventListener("click", function (){
            stopPropagation();
            rechercherTitreParCote();
            div_modal.classList.add('hidden');
            overlay.classList.add('hidden');
            qrsacn.hidden = true;
        });
        function onScanError(errorMessage) {
            //handle scan error
        }

        function onScanSuccess(qrCodeMessage) {
            cote_ouvrage.value = qrCodeMessage;
            qrsacn.hidden = false;
            return;
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>
@stop


