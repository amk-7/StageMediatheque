@extends('layout.template.base')

@section('content')
<div class="flex flex-col justify-center items-center m-auto">
    <form method="POST" action="{{route($action)}}" enctype="multipart/form-data" class="bg-white p-12 mb-12">
        @csrf
        <h1 class="label_title text-center pb-12">{{$title}}</h1>
        <fieldset>
            <div class="flex flex-row space-x-3 justify-center items-center">
                <div class="w-2/6">
                    <label class="label" for="nom">Nom</label>
                    <input type="text" name="nom" id="nom"  value="{{old('nom')}}" class="input @error('nom') is-invalid @enderror">
                    @error('nom')
                    <div class="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-2/6">
                    <label class="label" for="prenom">Prenom</label>
                    <input type="text" id="prenom" value="{{old('prenom')}}" name="prenom" class="input @error('prenom') is-invalid @enderror">
                    @error('prenom')
                    <div class="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-2/6">
                    <label class="label" for="nom_utilisateur">Nom d'utilisateur</label>
                    <input type="text" id="nom_utilisateur" value="{{old('nom_utilisateur')}}" name="nom_utilisateur" class="input @error('nom_utilisateur') is-invalid @enderror">
                    @error('nom_utilisateur')
                    <div class="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex flex-row space-x-3">
               <div class="flex flex-col w-1/3 mt-6 mr-3">
                   <div>
                       <label class="label">Photo de profil</label>
                   </div>
                   <div class="border border-gray-200 text-center">
                       <img src="" alt="photo_profil" id="profil_object" width="200" height="200" size>
                   </div>
                   <div class="flex flex-col-reverse p-2">
                       <input type="file" onchange="previewPicture(this)" name="photo_profil" id="" value=""
                              accept="image/jpg, image/jpeg, image/png, image/jpeg"><br>
                   </div>
               </div>
                <div class="flex flex-col w-2/3 mt-6">
                    <div>
                        <label class="label" for="email">Email</label>
                        <input type="text" id="email" value="{{old('email')}}" name="email" class="input">
                    </div>
                    <div>
                        <label class="label" for="contact">Contact</label>
                        <input type="tel" id="contact" value="{{old('contact')}}" name="contact" class="input @error('contact') is-invalid @enderror">
                        @error('contact')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="label" for="password">Mot de passe</label>
                        <input type="password" id="password" value="{{old('password')}}" name="password" class="input @error('password') is-invalid @enderror">
                        @error('password')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div>
                <label class="label" for="adresse">Adresse : </label>
                <div class="flex flex-row space-x-2 justify-center items-center" >
                    <div class="w-2/6">
                        <label class="label" for="ville">Ville</label>
                        <input type="text" id="ville" value="{{old('ville')}}" name="ville" class="input @error('ville') is-invalid @enderror">
                        @error('ville')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-2/6">
                        <label class="label" for="quartier">Quartier</label>
                        <input type="text" id="quartier" value="{{old('quartier')}}" name="quartier" class="input @error('quartier') is-invalid @enderror">
                        @error('quartier')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-2/6">
                        <label class="label" for="numero_maison">Numero de maison</label>
                        <input type="text" id="numero_maison" value="{{old('numero_maison')}}" name="numero_maison" class="input">
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <label class="label" for="sexe">Sexe : </label>
                <div class="flex flex-row space-x-8 text-center">
                    <div>
                        <input type="radio" name="sexe" value="Masculin"/>
                        <label>Masculin</label>
                    </div>
                    <div>
                        <input type="radio" name="sexe" value="Feminin"/>
                        <label>Feminin</label>
                    </div>
                </div>
            </div>

            @yield('abonne')
            @yield('personnel')
            <button class="button button_primary w-full mt-12" type="Submit">Enregistrer</button>
        </fieldset>
    </form>
    @include("layout.ouvrageZJS.ouvrageLoadFile")
</div>
@endsection
