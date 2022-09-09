@extends('layout.base')

@section('content')
    {{--dd($emprunt->personnel->utilisateur->nom)--}}
    <h1> Information sur l'emprunt </h1>
    <label>
        <span class="label_title_sub_title">Date Emprunt:</span>
        <span class="label_show_value">{{ App\Service\GlobaleService::afficherDate($emprunt->date_emprunt)}}</span>
    </label></br>

    <label>
        <span class="label_title_sub_title">Date Retour:</span>
        <span class="label_show_value">{{App\Service\GlobaleService::afficherDate($emprunt->date_retour)}}</span>
    </label></br>

    <label>
        <span class="label_title_sub_title">Personnel :</span>
        <span class="label_show_value">{{$emprunt->personnel->utilisateur->userFullName}}</span>
    </label></br>

    <label>
        <span class="label_title_sub_title">Abonne :</span>
        <span class="label_show_value">{{$emprunt->abonne->utilisateur->userFullName}}</span>
    </label>

@endsection
