@extends('layout.user.userShow', ['action'=>"showAbonne", 'title'=>"Afficher un abonne", 'utilisateur'=>$abonne->utilisateur, 'model'=>$abonne])

@section('abonne')

        <div class="label">
                <label> Date Naissance : </label>
                <label>{{$abonne->date_naissance->format('d/m/Y')}}</label>
        </div>

        <div class="label">
                <label> Niveau Etude : </label>
                <label>{{$abonne->niveau_etude}}</label>
        </div>
        
        <div class="label">
                <label> Profession : </label>
                <label>{{$abonne->profession}}</label>
        </div>

        <div class="label">
                <label> Contact à prevenir : </label>
                <label>{{$abonne->contact_a_prevenir}}</label>
        </div>

        <div class="label">
                <label> Numero Carte : </label>
                <label>{{$abonne->numero_carte}}</span>
        </div>

        <div class="label">
                <label> Type de Carte : </label>
                <label>{{$abonne->type_de_carte}}</label>
        </div>



@endsection