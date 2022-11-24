@extends('layout.user.userShow', ['action'=>"editAbonne", 'title'=>"Afficher un abonne", 'utilisateur'=>$abonne->utilisateur, 'model'=>$abonne])

@section('abonne')

        <label>
                <span class="label_title_sub_title"> Date Naissance : </span>
                <span class="label_show_value">{{$abonne->date_naissance->format('d/m/Y')}}</span>
        </label>

        <label>
                <span class="label_title_sub_title"> Niveau Etude : </span>
                <span class="label_show_value">{{$abonne->niveau_etude}}</span>
        </label>

        <label>
                <span class="label_title_sub_title"> Profession : </span>
                <span class="label_show_value">{{$abonne->profession}}</span>
        </label>

        <label>
                <span class="label_title_sub_title"> Contact à prevenir : </span>
                <span class="label_show_value">{{$abonne->contact_a_prevenir}}</span>
        </label>

        <label>
                <span class="label_title_sub_title"> Numero Carte : </span>
                <span class="label_show_value">{{$abonne->numero_carte}}</span>
        </label>

        <label>
                <span class="label_title_sub_title"> Type de Carte : </span>
                <span class="label_show_value">{{$abonne->type_de_carte}}</span>
        </label>
@endsection
