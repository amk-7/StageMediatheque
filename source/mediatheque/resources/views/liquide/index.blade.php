@extends('layout.template.base')

@section('content')
    <h1> Liste des registrations </h1>
    <form method="GET" action="{{route('createLiquide')}}">
        <button type="Submit">Faire un abonement</button>
    </form>
    <div>
        @if(!empty($liquides ?? "") && $liquides->count() > 0)
            <table border="1">
                <caption>Liste des registrations</caption>
                <thead>
                <tr>
                    <th>Abonne</th>
                    <th>Tarif</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                    <th>Consulter</th>
                    <th>Editer</th>
                </tr>
                </thead>
                <tbody>
                @foreach($liquides as $liquide)
                    <tr>
                        <td> {{ $liquide->registration->abonne->utilisateur->userFullName }} </td>
                        <td> {{ $liquide->registration->tarifAbonnement->designation }} </td>
                        <td> {{ $liquide->registration->date_debut->format('Y-m-d') }} </td>
                        <td> {{ $liquide->registration->date_fin->format('Y-m-d') }} </td>
                        <td>
                            <form action="" method="">
                                <input type="submit" value="Consulter" disabled>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('editLiquide', $liquide)}}" method="get">
                                <input type="submit" value="Editer" disabled>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h4>Aucune Liquidité</h4>
        @endif
    </div>

@endsection
