@extends('layout.base')
@section('content')
    <h1>Edition du livre {{$livresPapier->ouvragePhysique->ouvrage->titre }} </h1>
    <form action="{{ route("modificationLivrePapier", $livresPapier) }}" method="post" enctype="multipart/form-data">
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
        <fieldset>
            <legend>Particularité</legend>
            <div>
                <label>Catégorie</label>
                <select name="categorie" id="categorie">
                    <option>--Sélectionner categorie--</option>
                    @foreach($categories as $categorie)
                        <option value="{{$categorie}}">{{$categorie}}</option>
                    @endforeach
                </select>
                <div id="categories">
                    @foreach($livresPapier->categorie as $categorie)
                        <input type="text" name="categorie{{$loop->index}}" value="{{ $categorie }}"/>
                        <button>x</button>
                    @endforeach
                </div>
            </div>
            <div>
                <label>ISBN</label>
                <input name="ISBN" type="text" value=" {{ $livresPapier->ISBN }}"
                       placeholder="Saisire l'ISBN de l'ouvrage">
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
                    <input name="date_decces" type="date" value="">
                </div>
                <button id="ajouter_auteur">Ajouter</button>
            </div>
            <div id="liste_auteur">
                @foreach($livresPapier->ouvragePhysique->ouvrage->auteurs as $auteur)
                    <input type="text" name="auteur{{$loop->index}}" value="{{ $auteur->nom }}, {{ $auteur->prenom }}"/>
                    <button>x</button>
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
        <fieldset>
            <legend>Stock</legend>
            <div>
                <label>Nombre d'exemplaire</label>
                <input name="nombre_exemplaire" type="number"
                       value="{{ $livresPapier->ouvragePhysique->nombre_exemplaire }}">
            </div>
            <div>
                <label>Etat</label>
                <select id="etat" name="etat" class="@error('etat') is-invalid @enderror">
                    <option>--Sélectionner--</option>
                    @for ($i = 5; $i > 0; $i--)
                        <option value="{{ $i }}">{{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label>Dinsponibilité</label>
                <select id="disponibilite" name="disponibilite" class="@error('etat') is-invalid @enderror">
                    <option>--Sélectionner--</option>
                    <option value="1">Disponible</option>
                    <option value="0">Nom disponible</option>
                </select>
            </div>
            <div>
                <label>Emplacement</label>
                <div>
                    <label>Rayons</label>
                    <select id="id_classification_dewey_centaine" name="id_classification_dewey_centaine">
                        <option>--Sélectionner--</option>
                        @foreach($classification_dewey_centaines as $classification_dewey_centaine)
                            <option
                                value="{{$classification_dewey_centaine->id_classification_dewey_centaine}}">{{$classification_dewey_centaine->theme}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Etagère</label>
                    <select id="id_classification_dewey_dizaine" name="id_classification_dewey_dizaine">
                        <option>--Sélectionner etagère--</option>
                    </select>
                </div>
            </div>
        </fieldset>
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
    <script type="text/javascript" async>

        let selectRayon = document.getElementById("id_classification_dewey_centaine");
        let selectEtagere = document.getElementById("id_classification_dewey_dizaine");

        //console.log(JSON.parse(sessionStorage.getItem("liste_etagers")));

        const rayon_selected_value = "{!! $livresPapier->ouvragePhysique->classificationDeweyDizaine->classificationDeweyCentaine->first()->theme !!}";
        const etager_selected_value = "{!! $livresPapier->ouvragePhysique->classificationDeweyDizaine->id_classification_dewey_dizaine !!}";

        console.log(rayon_selected_value);
        // Mettre à jour le rayon et l'étagère.
        for (let i = 0; i < selectRayon.options.length; i++) {
            //console.log(selectRayon.options[i].innerText);
            if (selectRayon.options[i].innerText == rayon_selected_value) {
                // Mettre à jour le rayon.
                selectRayon.selectedIndex = selectRayon.options[i].index;
                let json_etager = JSON.parse(sessionStorage.getItem("liste_etagers"));
                for (let j = 0; j < json_etager.length; j++) {

                    if (selectRayon.options[i].value == json_etager[j].id_classification_dewey_centaine) {
                        let option = document.createElement("option");
                        option.value = json_etager[j].id_classification_dewey_dizaine;
                        option.innerText = json_etager[j].matiere;
                        selectEtagere.appendChild(option);
                        if (selectEtagere.options[j].value == etager_selected_value) {
                            // Mettre à jour le rayon l'étagère.
                            selectEtagere.selectedIndex = selectEtagere.options[j].index;
                        }
                    }
                }
            }
        }
        // Mettre les données de l'ouvrage.
        // Mettre le niveau.
        let niveau = "{!! $livresPapier->ouvragePhysique->ouvrage->niveau !!}";
        let type = "{!! $livresPapier->ouvragePhysique->ouvrage->type  !!}";
        let langue = "{!! $livresPapier->ouvragePhysique->ouvrage->langue !!}";
        let etat = {!! $livresPapier->ouvragePhysique->etat !!};
        let disponibilite = "{!! $livresPapier->ouvragePhysique->disponibilite !!}";
        if (disponibilite == "") {
            disponibilite = "0"
        }
        //console.log(etat)
        let annee_apparution = "{!! $livresPapier->ouvragePhysique->ouvrage->auteurs->first()->pivot->annee_apparution  !!}";

        //console.log(langue);
        selectionnerValeur("niveau", niveau);
        // Mettre le type.
        selectionnerValeur("type", type);
        // Mettre la langue.
        selectionnerValeur("langue", langue);
        // Mettre l'etat.
        selectionnerValeur("etat", etat);
        // Mettre l'annee d'apparution.
        selectionnerValeur("annee_apparution", annee_apparution);

        selectionnerValeur("disponibilite", disponibilite)

        function selectionnerValeur(id_balise_select, valeur) {
            let select_attribute = document.getElementById(`${id_balise_select}`);
            let select_attribute_values = select_attribute.options;
            //console.log(valeur);
            // enlever les espace avant la comparaison
            for (let i = 0; i < select_attribute_values.length; i++) {
                //console.log(select_attribute_values[i].value=="français");
                if (select_attribute_values[i].value == valeur) {
                    select_attribute.selectedIndex = select_attribute.options[i].index;
                }
            }
        }
    </script>
@stop
