@extends('layout.base')
@section('content')
    <h1 class="font-bold">{{$title}}</h1>
    <form action="{{route($action)}}" method="{{$methode}}" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend>Ouvrage</legend>
            <div>
                <div>
                    <label>Titre</label>
                    <input type="text" name="titre" value="" placeholder="saisir le titre du livre" class="@error('titre') is-invalid @enderror">
                    @error('titre')
                        <div class="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>Niveau</label>
                    <select id="ajouterNiveau" name="niveau" class="@error('niveau') is-invalid @enderror">
                        <option>--Selectionner--</option>
                        @foreach($niveaus as $niveau)
                            <option value="{{$niveau}}">{{$niveau}}</option>
                        @endforeach
                    </select>
                    @error('niveau')
                        <div class="alert">{{ $message }}</div>
                    @enderror
                    <div id="listeNiveau"></div>
                </div>
                <div>
                    <label>Type</label>
                    <select name="type" class="@error('type') is-invalid @enderror">
                        <option>--Selectionner--</option>
                        @foreach($types as $type)
                            <option value="{{$type}}">{{$type}}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <div class="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <div>
                        <img src="" alt="image_livre" id="image_livre" size>
                    </div>
                    <div>
                        <label>image</label>
                        <input type="file" onchange="previewPicture(this)" name="image_livre" id="" value="" accept="image/jpg, image/jpeg, image/png, image/jpeg"><br>
                    </div>
                </div>
                <div>
                    <label>langue</label>
                    <select name="langue">
                        <!--option>--Selectionner--</option-->
                        @foreach($langues as $langue)
                            <option value="{{$langue}}">{{$langue}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Année d'apparution</label>
                    <select name="annee_apparution" class="@error('annee_apparution') is-invalid @enderror">
                        @for($annee=1970; $annee<2023; $annee++)
                            <option value="{{$annee}}">{{$annee}}</option>
                        @endfor
                    </select>
                    @error('annee_apparution')
                        <div class="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>Lieu d'édition</label>
                    <input name="lieu_edition"type="text"  value="Sokodé" placeholder="Saisire le lieu d'édition" class="@error('lieu_edition') is-invalid @enderror">
                    @error('lieu_edition')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Auteur</legend>
            <div>
                <div>
                    <div>
                        <label>Nom</label>
                        <input name="nom" id="nom" type="text" value="KONDI" placeholder="Saisire le nom de l'auteur" class="@error('auteur0') is-invalid @enderror">
                    </div>
                    <div>
                        <label>Prénom</label>
                        <input name="prenom" id="prenom" type="text" value="abdoul" placeholder="Saisire le prénom de l'auteur">
                    </div>
                </div>
                @error('auteur0')
                    <div class="alert">{{ $message }}</div>
                @enderror
                <div id="auteurs">
                    <label>Auteurs : </label>
                    <div id="listeAuteurs"></div>
                </div>
                <div>
                    <button id="ajouterAuteur">Ajouter</button>
                </div>
            </div>
        </fieldset>
        @yield('particularite_papier')
        <fieldset>
            <legend>Mots clé </legend>
            <div id="motCle" name="">
                <table id="tableMotCle">
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input name="mot_cle_" id="inputMotCle" type="text" value="mot" placeholder="Entrez un mot clé"/>
                                    <button id="ajouterMotCle">+</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="listeBtns"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <fieldset>
            <legend>Résumé de l'ouvrage </legend>
            <textarea name="resume" rows="10" cols="100" placeholder="Saisir le résumé de l'ouvrage" class="@error('resume') is-invalid @enderror">Résumé</textarea>
            @error('resume')
                <div class="alert">{{ $message }}</div>
            @enderror
        </fieldset>
        @yield('stock')
        <input type="submit" id="enregistrer" name="enregister" value="Enregister"/>
    </form>
    <script type="text/javascript" async>
        var image = document.getElementById("profil_livre");
        var types = ["image/jpg", "image/jpeg", "image/png"];
        var previewPicture = function(e){
            const [picture] = e.files;
            if (types.includes(picture.type)){
                image_livre.src = URL.createObjectURL(picture);
            }
        }
    </script>
    <script src="{{ url('mediatheque_js/ouvrage/_ouvrage.js') }}" async></script>
@stop
