@extends('layout/base')
@section('content')
    <h1>Enregistrer nouveau un livre</h1>
    <form action="{{route('enregistementLivrePapier')}}" method="post">
        @csrf
        <fieldset>
            <legend>Ouvrage</legend>
            <div>
                <div>
                    <label>Titre</label>
                    <input type="text" name="titre" value="" placeholder="saisir le titre du livre">
                </div>
                <div>
                    <label>Niveau</label>
                    <select name="niveau">
                        @foreach($niveaus as $niveau)
                            <option value="{{$niveau}}">{{$niveau}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Type</label>
                    <select name="type">
                        @foreach($types as $type)
                            <option value="{{$type}}">{{$type}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <div>
                        <img src="" alt="profil" id="profil" size>
                    </div>
                    <div>
                        <label>image</label>
                        <input type="file" onchange="previewPicture(this)" name="avatar" id="" value="" accept="image/jpg, image/jpeg, image/png, image/jpeg"><br>
                    </div>
                </div>
                <div>
                    <label>langue</label>
                    <select name="langue">
                        @foreach($langues as $langue)
                            <option value="{{$langue}}">{{$langue}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Année d'apparution</label>
                    <select name="annee_apparution">
                        @for($annee=1970; $annee<2023; $annee++)
                            <option value="{{$annee}}">{{$annee}}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label>Lieu d'édition</label>
                    <input name="lieu_edition"type="text"  value="" placeholder="Saisire le lieu d'édition">
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Particularité</legend>
            <div>
                <label>Catégorie</label>
                <select name="categorie">
                    @foreach($categories as $categorie)
                        <option value="{{$categorie}}">{{$categorie}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>ISBN</label>
                <input name="ISBN" type="text" value="" placeholder="Saisire l'ISBN de l'ouvrage">
            </div>
        </fieldset>
        <fieldset>
            <legend>Auteur</legend>
            <div>
                <div>
                    <label>Nom</label>
                    <input name="nom" type="text" value="" placeholder="Saisire le nom de l'auteur">
                </div>
                <div>
                    <label>Prénom</label>
                    <input name="prenom" type="text" value="" placeholder="Saisire le prénom de l'auteur">
                </div>
                <div>
                    <label>Date de naissance</label>
                    <input name="date_naissance" type="date" value="">
                </div>
                <div>
                    <label>Date de decces</label>
                    <input name="date_decces" type="date" value="" >
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Stock</legend>
            <div>
                <label>Nombre d'exemplaire</label>
                <input name="nombre_exemplaire" type="number" value="" >
            </div>
            <div>
                <label>Etat</label>
                <input name="etat" type="text" value="" >
            </div>
        </fieldset>
        <button type="submit">Enregister</button>
    </form>

    <script type="text/javascript" async>
        var image = document.getElementById("profil");
        var types = ["image/jpg", "image/jpeg", "image/png"];
        var previewPicture = function(e){
            const [picture] = e.files;
            if (types.includes(picture.type)){
                profil.src = URL.createObjectURL(picture);
            }
        }
    </script>
@stop

