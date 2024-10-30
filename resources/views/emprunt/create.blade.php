@extends("layouts.app")
@section("content")
    @php
        $is_edit = ($emprunt ?? null && ($emprunt->id_emprunt ?? null)) ? true : false;
        $title = $is_edit ? "Mise à jour l'emprunt ".$emprunt->libelle : "Ajouter un nouveau emprunt" ;
        $action = $is_edit ? route("emprunts.update", $emprunt) : route("emprunts.store") ;
    @endphp
    <div class="flex flex-col justify-center items-center m-auto">
        <form action="{{$action}}" method="post" class="bg-white p-12 mb-12 space-y-3 border">
            @csrf
            @if($is_edit)
                @method('PUT')
            @endif
           <div class="flex flex-col items-center justify-center">
               <h1 class="label_title"> {{ $title }} </h1>
               <h3 class="label_title_sub_title">Date {{ date('Y-m-d') }}</h3>
           </div>
            <fieldset class="fieldset_border" >
                <legend>Abonné</legend>
                <div class="flex space-x-3">
                    <div class="flex flex-col w-full">
                        <label for="abonnee">Abonnée</label>
                        <select name="abonne" id="abonne" class="select_btn w-full">
                            <option value="">Séléctionner</option>
                            @foreach($abonnes as $abonne)
                                <option value="{{  $abonne->id_abonne }}" @selected($abonne->id_abonne==($emprunt->id_abonne ?? -1)) >{{  $abonne->nom }} {{  $abonne->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="alert">
                    @error('abonne')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="alert">
                    <p id="abonne_erreur" hidden>Vous devez séléctionner un abonnée</p>
                </div>
                <div class="alert">
                    <p id="abonne_non_eligible" hidden>L'abonné a déjà des emprunts en cours</p>
                </div>
                <div class="alert">
                    <p id="nombre_emprunt" hidden>Vous avez atteint le nombre maximum d'emprunt</p>
                </div>
            </fieldset>

            <fieldset class="fieldset_border space-y-3" >
                <legend>Ouvrage</legend>
                <div>
                    <div class="flex flex-col">
                        <label for="titre_ouvrage">Titre</label>
                        <div class="select_btn w-full">
                            <select name="titre" id="titre_ouvrage" class="w-full">
                                <option value="">Séléctionner</option>
                                @foreach($ouvrages as $ouvrage)
                                    <option value="{{  $ouvrage->id_ouvrage }}">{{  $ouvrage->titre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="alert">
                        <p id="titre_ouvrage_erreur" hidden>Vous devez séléctionner un ouvrage</p>
                    </div>
                    <div class="alert">
                        <p id="titre_ouvrage_erreur_2" hidden>Cet ouvrage existe déjà . </p>
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
                            <option value="{{$i}}" @selected($i==($nombreDeSemaines ?? 2))> {{$i}} Semaines</option>
                        @endfor
                    </select>
                </div>
            </fieldset>
            <div>
                <div class="flex space-x-8">
                    <button type="button" name="ajouter_emprunt" id="ajouter_emprunt" class="button button_primary w-2/5 p-2">Ajouter</button>
                </div>
                <div class="alert">
                    <p id="emprunt_erreur" hidden>Veuillez ajouter cet d'ouvrage.</p>
                </div>
            </div>
            <div class="alert">
                @error('ouvrages')
                    <span>Vous devez ajouter au moin un ouvrage.</span>
                @enderror
            </div>
           <fieldset class="fieldset_border flex flex-col items-center space-y-4">
               <h3 class="label_title_sub_title">Liste des Emprunts</h3>
               <table border="1" id="liste_emprunt" class="fieldset_border w-full">
                    <thead class="fieldset_border" >
                    <tr class="fieldset_border" >
                        <th class="fieldset_border" >N°</th>
                        <th class="fieldset_border" >Titre ouvrage</th>
                        <th class="fieldset_border" >Supprimer</th>
                    </tr>
                    </thead>
                    <tbody class="fieldset_border" id="current_lignes">
                        @foreach(($emprunt->lignesEmprunts ?? []) as $ligne)
                        <tr>
                            <td class="fieldset_border">1</td>
                            <td class="fieldset_border">
                                <input hidden name="ouvrages[]" value="{{$ligne->ouvrage->id_ouvrage}}">
                                <input hidden name="id_lignes[]" value="{{$ligne->id_ligne_emprunt}}">
                                <span>{{ $ligne->ouvrage->titre }}</span>
                            </td>
                            <td class="fieldset_border">
                                <button id="{{ $loop->index }}" type="button" onclick="removeLine('{{ $loop->index }}')" class="button button_delete">Supprimer</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
               </table>
           </fieldset>
            <input type="submit" id="action_emprunter" name="action_emprunt" value="Emprunter" class="button button_primary w-full mt-3">
        </form>
    </div>
@stop
@section("js")
    <script src="https://reeteshghimire.com.np/wp-content/uploads/2021/05/html5-qrcode.min_.js"></script>
    <!--script src="{ { url('js/html5-qrcode/html5-qrcode.min.js') }}"></script-->
    <script type="text/javaScript">
        $(document).ready(function() {
            $('#titre_ouvrage').select2();
        });

        $(document).ready(function() {
            $('#abonne').select2();
        });
    </script>
    <script type="text/javaScript">        
        let abonne = document.getElementById('abonne');
        let titre = document.getElementById('titre_ouvrage');
        let donnee = document.getElementById('data');

        let btn_ajouter = document.getElementById('ajouter_emprunt');
        let submit_btn = document.getElementById('action_emprunter');
        let duree_emprunt = document.getElementById('duree_emprunt');

        let ouvrages_ids = {!! $ouvrages_ids !!};
        
        let nombre_emprunt = 0;        

        let abonne_erreur = document.getElementById('abonne_erreur');
        let titre_ouvrage_erreur = document.getElementById('titre_ouvrage_erreur');
        let titre_ouvrage_erreur_2 = document.getElementById('titre_ouvrage_erreur_2');
        let emprunts_erreur = document.getElementById('emprunt_erreur');
        let nombre_emprunt_erreur = document.getElementById('nombre_emprunt');

        function cleanErrorMessages(){
            abonne_erreur.hidden = true;
            titre_ouvrage_erreur.hidden = true;
        }
       
        let number =  $('#current_lignes').length+1;

        function stopPropagation(){
            event.preventDefault();
        }

        function cleanInput() {
            $('#titre_ouvrage').val('').trigger('change');
        }

        function validateEmpruntFrom(){

            if (abonne.value === "") {
                abonne_erreur.hidden = false;
                return false;
            }            
            if (titre.value === "") {
                titre_ouvrage_erreur.hidden = false;
                return false;
            }
            let current_ouvrages_selected = $('#titre_ouvrage').find(`option[value="${titre.value}"]`)
            
            console.log(ouvrages_ids);
            console.log(current_ouvrages_selected.val());
            
            if (ouvrages_ids.includes(parseInt(current_ouvrages_selected.val()))){
                titre_ouvrage_erreur_2.hidden = false;
                return false;
            }

            abonne_erreur.hidden = true;
            titre_ouvrage_erreur.hidden = true;
            titre_ouvrage_erreur_2.hidden = true;
            return true ;
        }


        btn_ajouter.addEventListener('click', function addApprovisionnement() {
            stopPropagation();
            cleanErrorMessages();
            if(validateEmpruntFrom()){
               //Verifier si le nombre d'emprunt n'est pas inferieur à 5 là on sort
                if (nombre_emprunt >= 2) {
                    nombre_emprunt_erreur.hidden = false;
                    stopPropagation();
                    return ;
                }

                let current_ouvrages_selected = $('#titre_ouvrage').find(`option[value="${titre.value}"]`)
                
                nombre_emprunt_erreur.hidden = true;
                let table_body = document.getElementById('liste_emprunt').children[1];
                let row = document.createElement('tr');
                let cell_number = document.createElement('td');

                let cell_ouvrage = document.createElement('td');
                let cell_ouvrage_title = document.createElement('span');
                let cell_ouvrage_id = document.createElement('input');
                let cell_id_ligne = document.createElement('input');


                let cell_supprimer = document.createElement('td');
                let button_supprimer = document.createElement('button');
                
                button_supprimer.innerText = "Supprimer";
                button_supprimer.id = number - 1;
                button_supprimer.classList = "button button_delete";
                
                button_supprimer.addEventListener('click', function (e) {
                    stopPropagation(e);
                    removeLine(button_supprimer.id);
                });

                cell_number.innerText = number;
                cell_ouvrage_id.name = "ouvrages[]";
                cell_id_ligne.name = "id_lignes[]";

                cell_ouvrage_id.hidden = true;
                cell_id_ligne.hidden = true;

                cell_ouvrage_id.value = current_ouvrages_selected.val();
                cell_id_ligne.value = -1;
                cell_ouvrage_title.innerText = current_ouvrages_selected.text();                
                cell_supprimer.appendChild(button_supprimer);
                number++;
                cell_number.classList = "fieldset_border";
                cell_ouvrage.classList = "fieldset_border";
                cell_supprimer.classList = "fieldset_border";

                cell_ouvrage.appendChild(cell_ouvrage_id);
                cell_ouvrage.appendChild(cell_id_ligne);
                cell_ouvrage.appendChild(cell_ouvrage_title);
                
                row.appendChild(cell_number);
                row.appendChild(cell_ouvrage);
                row.appendChild(cell_supprimer);
                
                table_body.appendChild(row);
                
                // mémoriser les ids
                ouvrages_ids.push(parseInt(current_ouvrages_selected.val()));
                
                //incrementer le nombre d'emprunt
                nombre_emprunt += 1;
                
                cleanInput();
            }
        });

        function removeLine(id) {
            let table_body = document.getElementById('liste_emprunt').children[1];        
            table_body.removeChild(table_body.children[id]);
            nombre_emprunt -= 1;
        }

        // function removeLine(id, table_body) {
        //     table_body.removeChild(table_body.children[id]);
        //     nombre_emprunt -= 1;
        // }


    </script>
@stop


