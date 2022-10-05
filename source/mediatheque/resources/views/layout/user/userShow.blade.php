@extends('layout.template.base')

@section('content')
<fieldset>
    <legend>{{$title}}</legend>
    <label>Photo de profil : </label></br>
    <img src="{{asset('storage/images/image_utilisateur').'/'.$model->utilisateur->photo_profil}}" width="350" height="300"></br>

    <label>
        <sapn class="label_title_sub_title">Nom : </sapn>
        <span class="label_show_value">{{$utilisateur->nom}}</span>
    </label></br>

    <label>
        <span class="label_title_sub_title">Prenom : </span>
        <span class="label_show_value">{{$utilisateur->prenom}}</span>
    </label></br>

    <label>
        <span class="label_title_sub_title">Nom d'utilisateur : </span>
        <span class="label_show_value">{{$utilisateur->nom_utilisateur}}</span>
    </label></br>

    <label>
        <span class="label_title_sub_title">Email : </span>
        <span class="label_show_value">{{$utilisateur->email}}</span>
    </label></br>

    <label>
        <span class="label_title_sub_title">Contact : </span>
        <span class="label_show_value">{{$utilisateur->contact}}</span>
    </label></br>

    <label>
        <span class="label_title_sub_title">Ville : </span>
        <span class="label_show_value">{{$utilisateur->adresse["ville"]}}</span>
    </label></br>

    <label>
        <span class="label_title_sub_title">Quartier : </span>
        <span class="label_show_value">{{$utilisateur->adresse["quartier"]}}</span>
    </label></br>

    <label>
        <span class="label_title_sub_title">Numero de maison : </span>
        <span class="label_show_value">{{$utilisateur->adresse["numero_maison"]}}</span>
    </label></br>

    <label>
        <span class="label_title_sub_title">Sexe : </span>
        <span class="label_show_value">{{$utilisateur->sexe}}</span>
    </label></br>

    @yield('abonne')
    @yield('personnel')
</fieldset>
@if(Auth::user()->hasRole('abonne'))
    <div>
        <form method="get" action="{{route('editAbonne', $abonne)}}">
            <button class="button button_primary" type="Submit">Editer</button>
        </form>
    </div>
@endif
@stop
