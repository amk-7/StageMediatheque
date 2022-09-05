@extends('layout.base', ['body_style'=> "bg-gray-200 flex content-center justify-center h-full items-center"])
@section('content')
   <main class="flex flex-col m-12">
       <div class="text-gray-700 text-center mb-12">
           <h1 class="text-2xl font-bold">{{$title}}</h1>
       </div>
       <form action="{{route($action)}}" method="post" enctype="multipart/form-data" class="bg-white p-12 m-auto">
           @csrf
           <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
               <legend>Ouvrage</legend>
               <div class="flex flex-col my-auto">
                   <div class="flex flex-col m-3">
                       <label for="titre" class="label">Titre</label>
                       <input type="text" name="titre" id="titre" value="{{ old('titre') }}" placeholder="saisir le titre du livre" autocomplete="off"
                              class="input @error('titre') is-invalid @enderror">
                       @error('titre')
                       <div class="alert">{{ $message }}</div>
                       @enderror
                   </div>
                   <div>
                       <label>image</label>
                   </div>
                   <div class="flex flex-row m-3">
                       <div class="border border-gray-200 text-center">
                           <img src="" alt="image_livre" id="profil_object" size>
                       </div>
                       <div class="flex flex-col-reverse p-2">
                           <input type="file" onchange="previewPicture(this)" name="image_livre" id="" value=""
                                  accept="image/jpg, image/jpeg, image/png, image/jpeg"><br>
                       </div>
                   </div>
                   <div class="flex flex-auto">
                       <div class="flex flex-col m-3">
                           <label class="label">Niveau</label>
                           <select id="ajouterNiveau" name="niveau" class="select_btn
                              @error('niveau') is-invalid @enderror">
                               <option>Sélectionner niveau</option>
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
                               <option>Sélectionner type</option>
                               @foreach($types as $type)
                                   <option value="{{$type}} {{ old('type') == $type ? 'selected':'' }} ">{{$type}}</option>
                               @endforeach
                           </select>
                           @error('type')
                           <div class="alert">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="flex flex-col m-3">
                           <label class="label" >langue</label>
                           <select name="langue" class="select_btn">
                               <option>Sélectionner langue</option>
                               @foreach($langues as $langue)
                                   <option value="{{$langue}} {{ old('langue') == $langue ? 'selected':'' }} ">{{$langue}}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="flex flex-col m-3">
                           <label class="label">Année d'apparution</label>
                           <select name="annee_apparution" id="annee_apparution" class="select_btn @error('annee_apparution') is-invalid @enderror">
                               <option>Séléctionner année</option>
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
                       <label class="label">Lieu d'édition</label>
                       <input name="lieu_edition" id="lieu_edition" type="text" value="{{ old('lieu_edition') }}" placeholder="Saisire le lieu d'édition"
                              class="input @error('lieu_edition') is-invalid @enderror" autocomplete="off">
                       @error('lieu_edition')
                       <div class="alert alert-danger">{{ $message }}</div>
                       @enderror
                   </div>
               </div>
           </fieldset>
           <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
               <legend>Auteur</legend>
               <div class="flex flex-col">
                   <div class="flex flex-row space-x-3">
                       <div>
                           <label class="label">Nom</label>
                           <div class="flex flex-col">
                               <input name="nom" id="nom" type="text" value="{{ old('nom') }}"
                                      placeholder="Saisire le nom de l'auteur"
                                      class="input @error('auteur0') is-invalid @enderror" autocomplete="off">
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
                           <label class="label">Prénom</label>
                           <div class="flex flex-row space-x-3">
                               <input name="prenom" id="prenom" placeholder="saisire le prenom de l'auteur" value="{{ old('prenom') }}"
                                      class="input" autocomplete="off">
                               <button id="ajouterAuteur" class="button button_plus">+</button>
                           </div>
                       </div>
                   </div>
                   @error('auteur0')
                   <div class="alert">{{ $message }}</div>
                   @enderror
                   <div id="auteurs">
                       <label class="label">Auteurs : </label>
                       <div id="listeAuteurs"></div>
                   </div>
               </div>
           </fieldset>
           @yield('particularite_papier')
           @yield('particularite_document')
           <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
               <legend>Mots clé</legend>
               <div id="motCle" name="">
                   <div class="flex flex-row space-x-3">
                       <input name="mot_cle_" id="inputMotCle" type="text" value="{{ old('mot_cle_') }}"
                              placeholder="Entrez un mot clé"
                              class="input" autocomplete="off"/>
                       <button class="button button_plus" id="ajouterMotCle">+</button>
                   </div>
                   <table id="tableMotCle" class="">
                       <tbody>
                       <tr>
                           <td>
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
           <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
               <legend>Résumé de l'ouvrage</legend>
               <textarea name="resume" rows="10" cols="85" placeholder="Saisir le résumé de l'ouvrage" value="{{ old('resume') }}"
                         class="bg-gray-200 focus:outline-none border border-gray-300 rounded-md resize-none focus:border-green-500 @error('resume') is-invalid @enderror">Résumé</textarea>
               @error('resume')
               <div class="alert">{{ $message }}</div>
               @enderror
           </fieldset>
           @yield('stock')
           <div>
               <input class="button button_edite w-full mt-12" type="submit" id="enregistrer" name="enregister" value="Enregister"/>
           </div>
       </form>
   </main>
    <!--script src="{--{ url('mediatheque_js/ouvrage/_ouvrage.js') }--}" async></script-->
@stop

@section("js")
    @include("layout.ouvrageZJS.ouvrageLoadFile")
    @include("layout.ouvrageZJS.ouvrageSendDataFormat")
    @include('layout.ouvrageZJS.ouvrageCreate')
    @yield('ouvrage_content_js')
    @yield('ouvrage_physique_content_js')
@stop

