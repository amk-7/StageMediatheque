@extends('layouts.app')
@section('content')
    @php
        $is_edit = ($ouvrage && ($ouvrage->id_ouvrage ?? null)) ? true : false;
        $title = $is_edit ? "Mise à jour de l'ouvrage ".$ouvrage->titre : "Ajouter un nouvelle ouvrage" ;
        $action = $is_edit ? route("ouvrages.update", $ouvrage) : route("ouvrages.store") ;
        $nb_exemplaire = $is_edit ? $ouvrage->nombre_exemplaire : null;
        $hasDigitalVersion = $is_edit ? $ouvrage->hasDigitalVersion : false;
        $hasPhysicalVersion = $is_edit ? $ouvrage->hasPhysicalVersion : false;
    @endphp
    <div class="flex flex-col justify-center items-center w-full ml-28 mx-12 space-y-6">
        <div class="border flex flex-col m-auto items-center margin p-12">
            <form action="{{ $action }}" method="post" class="w-full">
                @csrf
                @if($is_edit)
                    @method('PUT')
                @endif
                <div class="space-y-6">
                    <h1 class="label_title"> {{ $title ?? "" }} </h1>
                    <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
                        <legend>Ouvrage</legend>
                        <div class="flex space-x-3">
                            <div class="flex flex-col w-1/3">
                                <div>
                                    <label class="label">Image</label>
                                </div>
                                <div class="border border-gray-200 text-center">
                                    <img src="{{ $ouvrage ? $ouvrage->coverPath : '' }}" alt="image_livre" id="profil_object" height="250px" width="250">
                                </div>
                                <div class="flex flex-col-reverse p-2">
                                    <input type="file" onchange="previewPicture(this)" name="image_livre" id="" value=""
                                        accept="image/jpg, image/png, image/jpeg">
                                </div>
                            </div>
                            <div class="flex flex-col w-2/3 space-y-3">
                                <div class="w-full space-y-3">
                                    <div class="w-full">
                                        <label for="titre" class="label">Titre</label>
                                        <input type="text" name="titre" id="titre" value="{{ @old('titre', $is_edit ? $ouvrage->titre : '') }}"
                                            placeholder="saisir le titre du livre" autocomplete="off"
                                            class="input @error('titre') border border-red-600 @else border-gray-300 @enderror">
                                    </div>
                                    @error('titre')
                                    <div>
                                        <span class="error"> {{ $message }} </span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="flex flex-col space-y-3">
                                    <div class="flex space-x-3 w-full">
                                        <div class="flex flex-col w-1/2">
                                            <label class="label">Niveau </label>
                                            <select name="niveau" class="select_btn @error('niveau') border border-red-600 @else border-gray-300 @enderror">
                                                <option>Sélectionner niveau</option>
                                                @foreach($niveaux as $niveau)
                                                    @php
                                                        if ($ouvrage ?? null) {
                                                            $current_value = $ouvrage->id_niveau;
                                                        }  else {
                                                            $current_value = old('niveau');
                                                        }
                                                    @endphp
                                                    <option value="{{$niveau->id_niveau}}" {{ $current_value == $niveau->id_niveau ? 'selected':'' }} > {{ $niveau->libelle }} </option>
                                                @endforeach
                                            </select>
                                            @error('niveau')
                                            <div class="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col w-1/2">
                                            <label class="label">Type</label>
                                            <select name="type" id="type" class="select_btn @error('type') border border-red-600 @else border-gray-300 @enderror">
                                                <option>Sélectionner type</option>
                                                @foreach($types as $type)
                                                    @php
                                                        if ($ouvrage ?? null) {
                                                            $current_value = $ouvrage->id_type;
                                                        }  else {
                                                            $current_value = old('type');
                                                        }
                                                    @endphp
                                                    <option value="{{$type->id_type_ouvrage}}" {{ $current_value == $type->id_type_ouvrage ? 'selected':'' }}>{{$type->libelle}}</option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                            <div class="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex space-x-3 w-full">
                                        <div class="flex flex-col w-1/2">
                                            <label class="label">langue</label>
                                            <select name="langues[]" class="select-multiple select_btn @error('langues') border border-red-600 @else border-gray-300 @enderror" multiple>
                                                <option>Sélectionner langue</option>
                                                @foreach($langues as $langue)
                                                    @php
                                                        if ($ouvrage ?? null) {
                                                            $value = $ouvrage->langues->contains($langue);
                                                        }
                                                    @endphp
                                                    @if(($ouvrage ?? null) && ! old('langues'))
                                                        <option value="{{$langue->id_langue}}" {{ $value == $langue->id_langue ? 'selected':'' }}>{{$langue->libelle}}</option>
                                                    @else
                                                        <option value="{{$langue->id_langue}}" {{ in_array($langue->id_langue, old('langues') ?? []) ? 'selected':'' }}>{{$langue->libelle}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('langues')
                                            <div class="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col w-1/2">
                                            <label class="label">Année d'apparution</label>
                                            <input name="annee_apparution" id="annee_apparution" type="number" value="{{ $ouvrage->annee_apparution ?? old('annee_apparution') }}"
                                                class="input @error('annee_apparution') border border-red-600 @else border-gray-300 @enderror" autocomplete="off">
                                            @error('annee_apparution')
                                            <div class="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col w-full">
                                    <label class="label">Lieu d'édition</label>
                                    <input name="lieu_edition" id="lieu_edition" type="text" value="{{ $ouvrage->lieu_edition ?? old('lieu_edition') }}"
                                        placeholder="Saisire le lieu d'édition"
                                        class="input @error('lieu_edition') border border-red-600 @else border-gray-300 @enderror" autocomplete="off">
                                    @error('lieu_edition')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-3 space-x-0"> 
                            <div class="">
                                <label class="label">Domaine</label>
                                <select name="domaines[]" class="select-multiple select_btn @error('domaines') border border-red-600 @else border-gray-300 @enderror" multiple>
                                    @foreach($domaines as $domaine)
                                        @php
                                            if ($ouvrage ?? null) {
                                                $value = $ouvrage->domaines->contains($domaine);
                                            }
                                        @endphp
                                        @if(($ouvrage ?? null) && ! old('domaines'))
                                            <option value="{{$domaine->id_domaine}}" {{ $value == $domaine ? 'selected':'' }}>{{$domaine->libelle}}</option>
                                        @else
                                            <option value="{{$domaine->id_domaine}}"  {{ in_array($domaine->id_domaine, old('domaines') ?? []) ? 'selected':'' }}>{{$domaine->libelle}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('domaines')
                                <div class="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="label">ISBN</label>
                                <input name="isbn" type="text" value="{{ $ouvrage->isbn ?? old('isbn') }}" placeholder="Saisire l'ISBN de l'ouvrage"
                                    class="input @error('isbn') border border-red-600 @else border-gray-300 @enderror">
                            </div>
                            @error('isbn')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div> 
                    </fieldset>
                    <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
                        <legend>Auteur</legend>
                        <input type="text" name="data_auteurs" id="data_auteurs" hidden>
                        <div class="flex flex-col">
                            <div class="flex flex-row space-x-3 w-full">
                                <div class="w-1/2">
                                    <label class="label">Nom</label>
                                    <div class="flex flex-col">
                                        <input name="auteur" id="nom" type="text" value="{{ old('nom') }}"
                                            placeholder="Saisire le nom de l'auteur"
                                            class="input @error('auteur') border border-red-600 @else border-gray-300 @enderror" autocomplete="off">
                                        <ul id="searche_options" class="overflow-y-auto h-16 bg-gray-50 border border-gray-300
                                    text-gray-900 text-sm rounded-lg block w-full p-2">
                                            @foreach($auteurs as $auteur)
                                                <li class="auteurs hover:bg-gray-200" id="{{$auteur->id_auteur}}">
                                                    {{ $auteur->nom }}-{{ $auteur->prenom }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="w-1/2">
                                    <label class="label">Prénom</label>
                                    <div class="flex flex-row space-x-3">
                                        <input name="prenom" id="prenom" placeholder="saisire le prenom de l'auteur"
                                            value="{{ old('prenom') }}"
                                            class="input" autocomplete="off">
                                        <button id="ajouter_auteur" class="button button_primary">+</button>
                                    </div>
                                </div>
                            </div>
                            @error('auteur0')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                            <div id="auteurs" class="mt-3">
                                <label class="label">Auteurs : {{ old('data_auteurs') }} </label>
                                <div id="liste_auteurs" class="flex flex-wrap mt-3">
                                    @php
                                        $data_auteurs = [];
                                        if (old('data_auteurs')){
                                            $data_auteurs = explode(';', old('data_auteurs'));
                                        }
                                    @endphp
                                    @if($data_auteurs)
                                        @foreach( $data_auteurs as $data_auteur)
                                            @if(! empty($data_auteur))
                                                <div class="flex m-3" id="liste_auteurs-{{$loop->index}}">
                                                    <input type="text" id="" value="{{ $data_auteur }}" class="input_elt" disabled="">
                                                    <button type="button" onclick="removeElt('liste_auteurs-{{$loop->index}}')" class="button button_delete">supprimer</button>
                                                </div>
                                            @endif
                                        @endforeach
                                    @elseif($ouvrage ?? [])
                                        @foreach( $ouvrage->auteurs ?? [] as $data_auteur)
                                            @if(! empty($data_auteur))
                                                <div class="flex m-3" id="liste_auteurs-{{$data_auteur->id_auteur}}">
                                                    <input type="text" id="" value="{{ $data_auteur->nom }}, {{ $data_auteur->prenom }}" class="input_elt" disabled="">
                                                    <button type="button" onclick="removeElt('liste_auteurs-{{$data_auteur->id_auteur}}')" class="button button_delete">supprimer</button>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
                        <legend>Mots clé</legend>
                        <input type="text" name="data_mots_cle" id="data_mots_cle" hidden>
                        <div id="mot_cle" name="">
                            <div class="flex flex-row space-x-3">
                                <input name="mot_cle" id="input_mot_cle" type="text" value="{{ old('mot_cle_') }}"
                                    placeholder="Entrez un mot clé"
                                    class="input" autocomplete="off"/>
                                <button type="button" class="button button_primary" id="ajouter_mot_cle">+</button>
                            </div>
                            <div id="liste_mots_cle"  class="flex flex-wrap mt-3">
                                @php
                                    $data_mots_cle = [];
                                    if (old('data_mots_cle')){
                                        $data_mots_cle = explode(';', old('data_mots_cle'));
                                    }
                                @endphp
                                @if ($data_mots_cle)
                                    @foreach( $data_mots_cle ?? [] as $mot_cle)
                                        @if(! empty($mot_cle))
                                        <div class="flex m-3" id="mot_cle_{{$loop->index}}">
                                            <input type="text" name="ressource_{{$loop->index}}" class="input_elt" value="{{ $mot_cle }}" disabled/>
                                            <button type="button" onclick="removeElt('mot_cle_{{$loop->index}}')" class="button button_delete">supprimer</button>
                                        </div>
                                        @endif
                                    @endforeach
                                @elseif($ouvrage ?? [])
                                    @foreach($ouvrage->mot_cle as $mot_cle)
                                        @if(! empty($mot_cle))
                                        <div class="flex m-3" id="mot_cle_{{$loop->index}}">
                                            <input type="text" name="ressource_{{$loop->index}}" class="input_elt" value="{{ $mot_cle }}" disabled/>
                                            <button type="button" onclick="removeElt('mot_cle_{{$loop->index}}')" class="button button_delete">supprimer</button>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
                        <legend>Résumé de l'ouvrage</legend>
                        <textarea name="resume" rows="10" cols="10" placeholder="Saisir le résumé de l'ouvrage"
                                    class="bg-gray-200 w-full focus:outline-none border border-gray-300 rounded-md resize-none focus:border-green-500
                                    @error('resume') border border-red-600 @else border-gray-300 @enderror"
                            > {{ $ouvrage->resume ?? old('resume') }} </textarea>
                        @error('resume')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
                        <legend>Disponible en versions : </legend>
                        <div>
                            <div class="flex space-x-3">
                                <input type="checkbox" name="version_physique" id="version_physique" @if(old('version_physique', $hasPhysicalVersion)) checked @enderror>
                                <span class="label">physique</span>
                            </div>
                            <div class="flex space-x-3">
                                <input type="checkbox" name="version_electronique" id="version_electronique" @if(old('version_electronique', $hasDigitalVersion)) checked @enderror >
                                <span class="label">Electronique</span>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border border-solid border-gray-600 p-4 rounded-md @if(old('version_physique')) show @else hidden @enderror" id="physique">
                        <legend>Stock</legend>
                        <div>
                            <label class="label">Nombre d'exemplaire</label>
                            <input name="nombre_exemplaire" type="number" value="{{ $ouvrage->nombre_exemplaire ?? old('nombre_exemplaire') }}" class="input @error('nombre_exemplaire') border border-red-600 @else border-gray-300 @enderror">
                            @error('nombre_exemplaire')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </fieldset>
                    <fieldset class="border border-solid border-gray-600 p-4 rounded-md @if($hasPhysicalVersion) show @else hidden @enderror" id="electronique">
                        <legend>Documents pdf</legend>
                        <div>
                            <label class="label flex justify-between">
                                <span>Fichier</span>
                                <span>
                                    <a href="{{ $ouvrage->documentPath }}" target="_blank" rel="noopener noreferrer">
                                        {{ $ouvrage->documentPath }}
                                    </a>
                                </span>
                            </label>
                            <input name="document" type="file" value="{{ $ouvrage->document ?? old('document') }}" class="input @error('document') border border-red-600 @else border-gray-300 @enderror" accept=".pdf">
                            @error('document')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </fieldset>
                    <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
                        <legend>Ressources externes</legend>
                        <input hidden type="text" name="ressources_externe" id="ressources_externe" value="{{ $ouvrage->ressources_externe ?? old('ressources_externe') }}">
                        <div class="flex space-x-3">
                            <input type="text" id="input_external_ressource" class="input" autocomplete="off"/>
                            <button type="button" class="button button_primary" id="ajouter_ressource">+</button>
                        </div>
                        <div class="flex flex-wrap mt-3" id="external_ressource_list">
                        @if ($ouvrage ?? null)
                                @php
                                    $ressources_externes = explode(';', $ouvrage->ressources_externe);
                                @endphp
                                @foreach($ressources_externes as $ressource)
                                    @if(! empty($ressource))
                                    <div class="flex m-3" id="ressource_{{$loop->index}}">
                                        <input type="text" name="ressource_{{$loop->index}}" class="input_elt" value="{{ $ressource }}" disabled/>
                                        <button type="button" onclick="removeElt('ressource_{{$loop->index}}')" class="button button_delete">supprimer</button>
                                    </div>
                                    @endif
                                @endforeach
                        @endif
                        </div>
                        @error('ressources_externe')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <input type="submit" id="enregistrer" value="Enregistré" class="button button_primary w-full py-3 ">
                </div>
            </form>
        </div>
    </div>
@endsection


@section("js")
    @include("js.ouvrageSendDataFormat")
    @include('js.ouvrageCreate')
    @include("js.ouvrageLoadFile")
    <script type="text/javaScript">
        const ouvrage_nombre_exemplaire = '{!! $nb_exemplaire !!}';
        const ouvrage_document = '{!! $ouvrage->document !!}';

        const version_physique = document.getElementById('version_physique');
        const version_electronique = document.getElementById('version_electronique');
        const block_physique = document.getElementById('physique');
        const block_electronique = document.getElementById('electronique');

        if (parseInt(ouvrage_nombre_exemplaire)) {
            block_physique.classList.remove('hidden');
            version_physique.checked = true;
        }

        if ( ! (typeof ouvrage_document === "string" && ouvrage_document.length === 0)) {
            block_electronique.classList.remove('hidden');
            version_electronique.checked = true;
        }

        version_physique.addEventListener('click', function (e){
            if (version_physique.checked) {
                block_physique.classList.remove('hidden');
            } else {
                block_physique.classList.add('hidden');
            }
        });
        version_electronique.addEventListener('click', function (e){
            if (version_electronique.checked) {
                block_electronique.classList.remove('hidden');
            } else {
                block_electronique.classList.add('hidden');
            }
        });

        $(document).ready(function() {
            $('.select-multiple').select2();
        });

    </script>
@stop
