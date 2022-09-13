@extends('layout.template.base')
@section('content')
    <h1>Edition du livre {{$ouvrage->titre }} </h1>
    <form action="{{ route($action, $update_object) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("put")
        <fieldset>
            <legend>Ouvrage</legend>
            <div>
                <div>
                    <label>Titre</label>
                    <input type="text" name="titre" value="{{$ouvrage->titre }}"
                           placeholder="saisir le titre du livre">
                </div>
                <div>
                    <label>Niveau</label>
                    <select name="niveau" id="niveau">
                        <option>Sélectionner niveau</option>
                        @foreach($niveaus as $niveau)
                            <option value="{{$niveau}}" {{ $niveau == $ouvrage->niveau ? 'selected' : '' }}>
                                {{ \App\Helpers\OuvrageHelper::afficherNiveau($niveau) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Type</label>
                    <select name="type" id="type">
                        <option>Sélectionner type</option>
                        @foreach($types as $type)
                            <option value="{{$type}}" {{ $type == $ouvrage->type ? 'selected' : '' }}>{{$type}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <div>
                        <img src="" alt="image_livre" id="image_livre" size>
                    </div>
                    <div>
                        <label>image</label>
                        <input type="file" onchange="previewPicture(this)" name="image_livre" id="" value=""
                               accept="image/jpg, image/jpeg, image/png, image/jpeg"><br>
                    </div>
                </div>
                <div>
                    <label>langue</label>
                    <select name="langue" id="langue">
                        <option>Sélectionner langue</option>
                        @foreach($langues as $langue)
                            <option value="{{$langue}}" {{ $langue == $ouvrage->langue ? 'selected' : '' }}>{{$langue}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Année d'apparution</label>
                    <select name="annee_apparution" id="annee_apparution">
                        <option>Sélectionner annee</option>
                        @for($annee=$annees; $annee <= date('Y'); $annee++)
                            <option value="{{$annee}}" {{ $annee == $ouvrage->annee_apparution ? 'selected' : '' }}>{{$annee}}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label>Lieu d'édition</label>
                    <input name="lieu_edition" id="lieu_edition" type="text"
                           value="{{ $ouvrage->lieu_edition }}"
                           placeholder="Saisire le lieu d'édition">
                </div>
            </div>
        </fieldset>
        @yield("particularite")
        <fieldset>
            <legend>Auteur</legend>
            <input type="text" name="data_auteurs" id="data_auteurs" hidden>
            <div>
                <div>
                    <label class="label">Nom</label>
                    <div class="flex flex-col">
                        <input name="auteur" id="nom" type="text" value="{{ old('nom') }}"
                               placeholder="Saisire le nom de l'auteur"
                               class="input @error('auteur') is-invalid @enderror" autocomplete="off">
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
                <div>
                    <label>Prénom</label>
                    <input id="prenom" name="prenom" type="text" value="" placeholder="Saisire le prénom de l'auteur">
                </div>
                <button id="ajouter_auteur">Ajouter</button>
            </div>
            <div id="liste_auteurs">
                @foreach($ouvrage->auteurs as $auteur)
                    <input type="text" id="auteur{{$loop->index}}" name="auteur{{$loop->index}}"
                           value="{{ $auteur->nom }}, {{ $auteur->prenom }}" disabled/>
                    <button onclick="removeElt('liste_auteurs','auteur{{$loop->index}}')">x</button>
                @endforeach
            </div>
        </fieldset>
        <fieldset>
            <legend>Mots clé</legend>
            <input type="text" name="data_mots_cle" id="data_mots_cle" hidden>
            <div id="mot_cle">
                <div>
                    <input name="mot_cle" id="input_mot_cle" type="text" value="mot"
                           placeholder="Entrez un mot clé"/>
                    <button id="ajouter_mot_cle">+</button>
                </div>
                <div id="liste_mots_cle">
                    @foreach($ouvrage->mot_cle as $mot_cle)
                        @if(! empty($mot_cle))
                            <input type="text" id="mot_cle_{{$loop->index}}" name="mot_cle_{{$loop->index}}"
                                   value="{{ $mot_cle }}" disabled/>
                            <button onclick="removeElt('liste_mots_cle','mot_cle_{{$loop->index}}')">x</button>
                        @endif
                    @endforeach
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Résumé de l'ouvrage</legend>
            <textarea name="resume" rows="10" cols="100" placeholder="Saisir le résumé de l'ouvrage"
                      class="@error('resume') is-invalid @enderror">Résumé</textarea>
            @error('resume')
            <div class="alert">{{ $message }}</div>
            @enderror
        </fieldset>
        @yield("stock")
        <button id="enregistrer" type="submit">Enregister</button>
    </form>
@stop
@section('js')
    @yield('ouvrage_physique_content_js')
    @include("layout.ouvrageZJS.ouvrageEdite")
    @include("layout.ouvrageZJS.ouvrageCreate")
    @include("layout.ouvrageZJS.ouvrageLoadFile")
    @include("layout.ouvrageZJS.ouvrageSendDataFormat")
@stop
