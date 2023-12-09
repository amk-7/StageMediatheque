@extends('layouts.app')

@section('content')
<style>
    .show-card {
        display: flex;
    }

    @media screen and (max-width: 700px) {
        .show-card {
            flex-direction: column;
        }
    }
</style>
<div class="flex flex-col justify-center items-center m-auto">
    <form method="GET" action="{{route($action, $model)}}" class="my_content">
    {{--dd($utilisateur->adresse)--}}
    @csrf
    <main class=" bg-white flex flex-col items-center p-12">
        <h1 class="label_title text-center pb-12">{{$title}}</h1>
    <fieldset>
    <div class="show-card m-auto p-3.5">
        <div class="">
            <img src="{{asset('storage/images/image_utilisateur').'/'.$model->utilisateur->photo_profil}}" width="350" height="350"
            style="width: 350px; height: 350px"></br>
        </div>
        <div class="pl-6">
            <div class="flex flex-col">
                <label>
                    <span class="label_title_sub_title">Nom : </span>
                    <span class="label_title_sub_title">{{$utilisateur->nom}}</span>
                </label>

                <label>
                    <span class="label_title_sub_title">Prenom : </span>
                    <span class="label_title_sub_title">{{$utilisateur->prenom}}</span>
                </label>

            <label>
                <span class="label_title_sub_title">Nom d'utilisateur : </span>
                <span class="label_title_sub_title">{{$utilisateur->nom_utilisateur}}</span>
            </label>
            <label>
                <span class="label_title_sub_title">Email : </span>
                <span class="label_title_sub_title">{{$utilisateur->email}}</span>
            </label>

            <label>
                <span class="label_title_sub_title">Contact : </span>
                <span class="label_title_sub_title">{{$utilisateur->contact}}</span>
            </label>

            <label>
                <span class="label_title_sub_title">Ville : </span>
                <span class="label_title_sub_title">{{$utilisateur->adresse["ville"]}}</span>
            </label>

            <label>
                <span class="label_title_sub_title">Quartier : </span>
                <span class="label_title_sub_title">{{$utilisateur->adresse["quartier"]}}</span>
            </label>

            <label>
                <span class="label_title_sub_title">Numero de maison : </span>
                <span class="label_title_sub_title">{{$utilisateur->adresse["numero_maison"]}}</span>
            </label>

            <label>
                <span class="label_title_sub_title">Sexe : </span>
                <span class="label_title_sub_title">{{$utilisateur->sexe}}</span>
            </label>


        @yield('abonne')
        @yield('personnel')
            </div>
        </div>
    </div>
    </fieldset>
    @if(Auth::user()->hasRole('abonne'))
            <button class="button button_primary" type="Submit">Editer</button>
    @endif
    </main>
</form>
</div>
@stop
