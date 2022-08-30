@extends('layout.base')
@section('content')
    <h1>Edition du livre {{$livresPapier->ouvragePhysique->ouvrage->titre }} </h1>
    <form action="{{ route($action, $livresPapier) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("put")
        <fieldset>
            <legend>Ouvrage</legend>
            <div>
                <div>
                    <label>Titre</label>
                    <input type="text" name="titre" value="{{$livresPapier->ouvragePhysique->ouvrage->titre }}"
                           placeholder="saisir le titre du livre">
                </div>
                <div>
                    <label>Niveau</label>
                    <select name="niveau" id="niveau">
                        <option>--Sélectionner niveau--</option>
                        @foreach($niveaus as $niveau)
                            <option value="{{$niveau}}">{{$niveau}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Type</label>
                    <select name="type" id="type">
                        <option>--Sélectionner type--</option>
                        @foreach($types as $type)
                            <option value="{{$type}}">{{$type}}</option>
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
                        <option>--Sélectionner langue--</option>
                        @foreach($langues as $langue)
                            <option value="{{$langue}}">{{$langue}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Année d'apparution</label>
                    <select name="annee_apparution" id="annee_apparution">
                        <option>--Sélectionner annee--</option>
                        @for($annee=1970; $annee<2023; $annee++)
                            <option value="{{$annee}}">{{$annee}}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label>Lieu d'édition</label>
                    <input name="lieu_edition" id="lieu_edition" type="text"
                           value="{{ $livresPapier->ouvragePhysique->ouvrage->auteurs->first()->pivot->lieu_edition }}"
                           placeholder="Saisire le lieu d'édition">
                </div>
            </div>
        </fieldset>
        @yield("particularite")
        <fieldset>
            <legend>Auteur</legend>
            <div>
                <div>
                    <label>Nom</label>
                    <input id="nom" name="nom" type="text" value="" placeholder="Saisire le nom de l'auteur">
                </div>
                <div>
                    <label>Prénom</label>
                    <input id="prenom" name="prenom" type="text" value="" placeholder="Saisire le prénom de l'auteur">
                </div>
                <button id="ajouterAuteur">Ajouter</button>
            </div>
            <div id="listeAuteurs">
                @foreach($livresPapier->ouvragePhysique->ouvrage->auteurs as $auteur)
                    <input type="text" id="auteur{{$loop->index}}" name="auteur{{$loop->index}}"
                           value="{{ $auteur->nom }}, {{ $auteur->prenom }}"/>
                    <button onclick="removeAuteur('auteur{{$loop->index}}')">x</button>
                @endforeach
            </div>
        </fieldset>
        <fieldset>
            <legend>Mots clé</legend>
            <div id="motCle" name="">
                <table id="tableMotCle">
                    <tbody>
                    <tr>
                        <td>
                            <div>
                                <input name="mot_cle" id="inputMotCle" type="text" value="mot"
                                       placeholder="Entrez un mot clé"/>
                                <button id="ajouterMotCle">+</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="listeBtns">
                                @foreach($livresPapier->ouvragePhysique->ouvrage->mot_cle as $mot_cle)
                                    <input type="text" id="mot_cle_{{$loop->index}}" name="mot_cle_{{$loop->index}}"
                                           value="{{ $mot_cle }}"/>
                                    <button onclick="removeKeyWord('mot_cle_{{$loop->index}}')">x</button>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
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

    <script type="text/javascript" async>
        var image = document.getElementById("profil_livre");
        var types = ["image/jpg", "image/jpeg", "image/png"];
        var previewPicture = function (e) {
            const [picture] = e.files;
            if (types.includes(picture.type)) {
                image_livre.src = URL.createObjectURL(picture);
            }
        };
    </script>
    @include("layout.ouvrage.ouvrageData")
    <!--Mettre à jour les select box-->
    @include("layout.ouvrageZJS.ouvrageEdite")
    @include("layout.ouvrageZJS.ouvrageSendDataFormat")
@stop

