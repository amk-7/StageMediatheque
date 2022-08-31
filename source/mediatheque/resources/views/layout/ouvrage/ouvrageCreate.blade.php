@extends('layout.base')
@section('content')
    <h1 class="font-bold">{{$title}}</h1>
    <form action="{{route($action)}}" method="post" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend>Ouvrage</legend>
            <div>
                <div>
                    <label>Titre</label>
                    <input type="text" name="titre" id="titre" value="Titre test" placeholder="saisir le titre du livre"
                           class="@error('titre') is-invalid @enderror">
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
                    <select name="type" id="type" class="@error('type') is-invalid @enderror">
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
                        <input type="file" onchange="previewPicture(this)" name="image_livre" id="" value=""
                               accept="image/jpg, image/jpeg, image/png, image/jpeg"><br>
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
                    <select name="annee_apparution" id="annee_apparution" class="@error('annee_apparution') is-invalid @enderror">
                        <option>--Séléctionner année--</option>
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
                    <input name="lieu_edition" id="lieu_edition" type="text" value="Sokodé" placeholder="Saisire le lieu d'édition"
                           class="@error('lieu_edition') is-invalid @enderror">
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
                        <div>
                            <input name="nom" id="nom" type="text" value="KONDI"
                                   placeholder="Saisire le nom de l'auteur"
                                   class="@error('auteur0') is-invalid @enderror">
                            <ul id="searche_options">
                                @foreach($auteurs as $auteur)
                                    <li class="auteurs" id="{{$auteur->id_auteur}}">{{ $auteur->nom }}
                                        -{{ $auteur->prenom }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div>
                        <label>Prénom</label>
                        <select name="prenom" id="prenom">

                        </select>
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
        @yield('particularite_document')
        <fieldset>
            <legend>Mots clé</legend>
            <div id="motCle" name="">
                <table id="tableMotCle">
                    <tbody>
                    <tr>
                        <td>
                            <div>
                                <input name="mot_cle_" id="inputMotCle" type="text" value="mot"
                                       placeholder="Entrez un mot clé"/>
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
            <legend>Résumé de l'ouvrage</legend>
            <textarea name="resume" rows="10" cols="100" placeholder="Saisir le résumé de l'ouvrage"
                      class="@error('resume') is-invalid @enderror">Résumé</textarea>
            @error('resume')
            <div class="alert">{{ $message }}</div>
            @enderror
        </fieldset>
        @yield('stock')

        <input type="submit" id="enregistrer" name="enregister" value="Enregister"/>
    </form>
    @include("layout.ouvrageZJS.ouvrageLoadFile")
    @include("layout.ouvrageZJS.ouvrageSendDataFormat")
    <!--script src="{--{ url('mediatheque_js/ouvrage/_ouvrage.js') }--}" async></script-->

@stop


    <!--script type="text/javascript">
        let id_search_bar = "nom";
        let id_hidden_search_bar = "id_auteur";
        let options_class_name = "auteurs";
        let id_select_prenom = "prenom";
        let input_searche_bar = document.getElementById(id_search_bar);
        let hidden_input_searche_bar = document.getElementById(id_hidden_search_bar);
        let select_prenom = document.getElementById(id_select_prenom);

        console.log(id_search_bar);
        input_searche_bar.addEventListener("keyup", function () {
            search_object(id_search_bar, options_class_name);
        }, false);

        let search_options = document.getElementById("searche_options").children;

        for (let i = 0; i < search_options.length; i++) {
            search_options[i].addEventListener("click", function () {
                applySelected(input_searche_bar, search_options[i].id, hidden_input_searche_bar, select_prenom);
            }, false);
            console.log(search_options[i]);
        }

        function search_object(id_searchbar, class_elts) {
            console.log("ok");
            let input = document.getElementById(id_searchbar).value
            input = input.toLowerCase();
            let x = document.getElementsByClassName(class_elts);

            for (i = 0; i < x.length; i++) {
                if (!x[i].innerHTML.toLowerCase().includes(input)) {
                    x[i].style.display = "none";
                } else {
                    x[i].style.display = "list-item";
                }
            }
        }

        function applySelected(input, id_elt, input_hidden, select_prenom) {
            let li = document.getElementById(id_elt);
            let nom_prenom = li.innerText.split("-");
            input.value = nom_prenom[0];
            select_prenom.value = nom_prenom[1];
            input_hidden.value = id_elt;
        }
    </script-->

