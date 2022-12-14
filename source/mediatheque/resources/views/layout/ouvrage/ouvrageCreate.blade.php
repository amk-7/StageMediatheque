@extends('layout.template.base', ['body_style'=> "bg-gray-200 flex content-center justify-center h-full items-center"])
@section('content')
    <main class="flex flex-col justify-center items-center m-auto">
        <form action="{{route($action)}}" method="post" enctype="multipart/form-data" class="bg-white p-12 mb-12">
            @csrf
            <h1 class="label_title text-center pb-12">{{$title}}</h1>
            <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
                <legend>Ouvrage</legend>
                <div class="flex flex-col my-auto">
                    <div class="flex flex-col m-3">
                        <label for="titre" class="label">Titre</label>
                        <input type="text" name="titre" id="titre" value="{{ old('titre') }}"
                               placeholder="saisir le titre du livre" autocomplete="off"
                               class="input @error('titre') is-invalid @enderror">
                        @error('titre')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-row space-x-3">
                        <div class="flex flex-col w-1/3 mt-6 mr-3">
                            <div>
                                <label class="label">Image</label>
                            </div>
                            <div class="border border-gray-200 text-center">
                                <img src="" alt="image_livre" id="profil_object" width="200" height="250" size>
                            </div>
                            <div class="flex flex-col-reverse p-2">
                                <input type="file" onchange="previewPicture(this)" name="image_livre" id="" value=""
                                       accept="image/jpg, image/jpeg, image/png, image/jpeg"><br>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <div class="flex flex-col m-3">
                                    <label class="label">Niveau</label>
                                    <select id="ajouterNiveau" name="niveau" class="select_btn
                                  @error('niveau') is-invalid @enderror">
                                        <option>S??lectionner niveau</option>
                                        @foreach($niveaus as $niveau)
                                            <option value="{{$niveau}}" {{ old('niveau') == $niveau ? 'selected':'' }}>{{ \App\Helpers\OuvrageHelper::afficherNiveau($niveau) }}</option>
                                        @endforeach
                                    </select>
                                    @error('niveau')
                                    <div class="alert">{{ $message }}</div>
                                    @enderror
                                    <div id="listeNiveau"></div>
                                </div>
                                <div class="flex flex-col m-3">
                                    <label class="label">Type</label>
                                    <select name="type" id="type" class="select_btn @error('type') is-invalid @enderror">
                                        <option>S??lectionner type</option>
                                        @foreach($types as $type)
                                            <option value="{{$type}}" {{ old('type') == $type ? 'selected':'' }}>{{$type}}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <div class="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-row">
                                <div class="flex flex-col m-3">
                                    <label class="label">langue</label>
                                    <select name="langue" class="select_btn">
                                        <option>S??lectionner langue</option>
                                        @foreach($langues as $langue)
                                            <option value="{{$langue}}" {{ old('langue') == $langue ? 'selected':'' }}>{{$langue}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col m-3">
                                    <label class="label">Ann??e d'apparution</label>
                                    <select name="annee_apparution" id="annee_apparution"
                                            class="select_btn @error('annee_apparution') is-invalid @enderror">
                                        <option>S??l??ctionner ann??e</option>
                                        @for($annee=$annees; $annee< date('Y'); $annee++)
                                            <option value="{{$annee}}" {{ old('annee') == $annee ? 'selected':'' }} >{{$annee}}</option>
                                        @endfor
                                    </select>
                                    @error('annee_apparution')
                                    <div class="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col m-3">
                                <label class="label">Lieu d'??dition</label>
                                <input name="lieu_edition" id="lieu_edition" type="text" value="{{ old('lieu_edition') }}"
                                       placeholder="Saisire le lieu d'??dition"
                                       class="input @error('lieu_edition') is-invalid @enderror" autocomplete="off">
                                @error('lieu_edition')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
                <legend>Auteur</legend>
                <input type="text" name="data_auteurs" id="data_auteurs" hidden>
                <div class="flex flex-col">
                    <div class="flex flex-row space-x-3">
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
                            <label class="label">Pr??nom</label>
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
                    <div id="auteurs">
                        <label class="label">Auteurs : </label>
                        <div id="liste_auteurs"></div>
                    </div>
                </div>
            </fieldset>
            @yield('particularite_papier')
            @yield('particularite_document')
            @yield('particularite_numerique')
            <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
                <legend>Mots cl??</legend>
                <input type="text" name="data_mots_cle" id="data_mots_cle" hidden>
                <div id="mot_cle" name="">
                    <div class="flex flex-row space-x-3">
                        <input name="mot_cle" id="input_mot_cle" type="text" value="{{ old('mot_cle_') }}"
                               placeholder="Entrez un mot cl??"
                               class="input" autocomplete="off"/>
                        <button class="button button_primary" id="ajouter_mot_cle">+</button>
                    </div>
                    <div id="liste_mots_cle"></div>
                </div>
            </fieldset>
            <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
                <legend>R??sum?? de l'ouvrage</legend>
                <textarea name="resume" rows="10" cols="85" placeholder="Saisir le r??sum?? de l'ouvrage"
                          value="{{ old('resume') }}"
                          class="bg-gray-200 focus:outline-none border border-gray-300 rounded-md resize-none focus:border-green-500 @error('resume') is-invalid @enderror">R??sum??</textarea>
                @error('resume')
                <div class="alert">{{ $message }}</div>
                @enderror
            </fieldset>
            @yield('stock')
            <div class="flex space-x-3">
                <input class="button button_primary w-full mt-12" type="submit" id="enregistrer" name="enregister"
                       value="Enregister"/>
            </div>
        </form>
    </main>
@stop
@section("js")
    @include("layout.ouvrageZJS.ouvrageSendDataFormat")
    @include('layout.ouvrageZJS.ouvrageCreate')
    @include("layout.ouvrageZJS.ouvrageLoadFile")
    @yield('ouvrage_physique_content_js')
@stop

