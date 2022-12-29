@extends('layout.template.base')

@section('content')

<form method="POST" action="{{route($action, $model)}}" enctype="multipart/form-data" class="bg-white p-12 m-auto">
<h1 class="label_title text-center pb-12">{{$title}}</h1>
<fieldset>
    {{csrf_field()}}
    {{ method_field('PUT') }}

    <div class="flex flex-row space-x-3 justify-center items-center">
        <div class="w-1/2" >
            <label class="label" for="nom">Nom</label>
            <input type="text" name="nom" value="{{$utilisateur->nom}}" class="input" >
        </div>

        <div class="w-1/2">
            <label class="label" for="prenom">Prenom</label>
            <input type="text" name="prenom" value="{{$utilisateur->prenom}}" class="input">
        </div>
    </div>

    <div class="flex flex-row space-x-3">
        <div class="flex flex-col w-1/3 mt-6 mr-3">
            <div>
                <label class="label" for="photo_profil">Photo de profil : </label>
            </div>
            <div class="border border-gray-200 text-center">
                <img src="{{asset('storage/images/image_utilisateur').'/'.$model->utilisateur->photo_profil}}" width="350" height="350"
                     style="width: 350px; height: 350px">
            </div>
            <div class="flex flex-col-reverse p-2">
                <input type="file" name="photo_profil" value="{{$utilisateur->photo_profil}}">
            </div>

        </div>
        <div class="flex flex-col w-2/3 mt-6">
            <div>
                <label class="label" for="email">Email <span class="optionnel">(optionnel)</span></label>
                <input type="text" name="email" value="{{$utilisateur->email}}" class="input">
            </div>
            <div class="flex space-x-3 mt-4 mb-1">
                <label class="label">Changer le mot de passe : </label>
                <input type="checkbox" value="change_password" id="change_password">
            </div>
            <span class="optionnel">Cocher pour pouvoir modifier le mot de passe.</span>
            <div>
                <label class="label" for="password">Mot de passe</label>
                <input type="password" id="password" placeholder="Au moins 8 carractères...." value="{{old('password')}}" name="password" class="input @error('password') is-invalid @enderror" disabled>
                @error('password')
                <div class="alert">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="label" for="confirmation_password">Confirmation du mot de passe</label>
                <input type="password" id="confirmation_password" placeholder="Resaisisez le mot de passe..." value="{{old('confirmation_password')}}" name="confirmation_password" class="input @error('confirmation_password') is-invalid @enderror" disabled>
                @error('confirmation_password')
                <div class="alert">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div>
        <div>
            <label class="label" for="contact">Contact</label>
            <input type="tel" name="contact" value="{{$utilisateur->contact}}" class="input">
        </div>
        <label class="label" for="adresss">Adresss</label>
        <div class="flex flex-row space-x-2 justify-center items-center">
            <div class="w-2/6">
                <label class="label" for="ville">Ville</label>
                <input type="text" name="ville" value="{{$utilisateur->adresse['ville']}}" class="input">
            </div>

            <div class="w-2/6">
                <label class="label" for="quartier">Quartier</label>
                <input type="text" name="quartier" value="{{$utilisateur->adresse['quartier']}}" class="input">
            </div>

            <div class="w-2/6">
                <label class="label" for="numero_maison">Numero de maison <span class="optionnel">(optionnel)</span> </label>
                <input type="text" name="numero_maison" value="{{$utilisateur->adresse['numero_maison']}}" class="input">
            </div>
        </div>
    </div>

    <div class="flex flex-col">
            <label class="label" for="sexe">Sexe : </label>
            <div class="flex flex-row space-x-8 text-center">
                <div class="label">
                    <input type="radio" name="sexe" value="Masculin" {{ $utilisateur->sexe == "Masculin" ? "checked" : "" }}/>
                    <label>Masculin</label>
                </div>
                <div class="label">
                    <input type="radio" name="sexe" value="Feminin" {{ $utilisateur->sexe == "Feminin" ? "checked" : "" }}/>
                    <label>Feminin</label>
                </div>
            </div>
    </div>

    @yield('abonne')
    @yield('personnel')

    <button class="button button_primary w-full mt-12" type="Submit">Modifier</button>
</fieldset>
</form>
@include("layout.ouvrageZJS.ouvrageLoadFile")
<script type="text/javascript">
    let change_password = document.getElementById('change_password');
    let password = document.getElementById('password');
    let password_confirm = document.getElementById('confirmation_password');
    change_password.addEventListener('change', function (e){
        if (password.disabled == true){
            password.disabled = false;
            password_confirm.disabled = false;
        } else {
            password.disabled = true;
            password_confirm.disabled = true;
        }
    });
</script>
@stop
