@extends('layout.template.base')

@section('content')
    <h1> Liste des registrations </h1>
    <form method="GET" action="{{route('createRegistration')}}">
        <button type="Submit">Ajouter une registration</button>
    </form>
    <div>
        @if(!empty($registrations ?? "") && $registrations->count() > 0)
            <table border="1">
                <caption>Liste des registrations</caption>
                <thead>
                <tr>
                    <th>Idendifiant de l'abonne</th>
                    <th>Idendifiant du Tarif</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                    <th>Consulter</th>
                    <th>Editer</th>
                    <th>Restituer</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                @foreach($registrations as $registration)
                    <tr>
                        <td> {{ $registration->id_abonne }} </td>
                        <td> {{ $registration->id_tarif }} </td>
                        <td> {{ $registration->date_debut->format('Y-m-d') }} </td>
                        <td> {{ $registration->date_fin->format('Y-m-d') }} </td>
                        <td>
                            <form action="" method="">
                                <input type="submit" value="Consulter">
                            </form>
                        </td>
                        <td>
                            <form action="{{route('editRegistration', $registration)}}" method="get">
                                <input type="submit" value="Editer">
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('formulaireEnregistrementRestitution', $registration) }}"
                                  method="get">
                                <input type="submit" value="Restituer">
                            </form>
                        </td>
                        <td>
                            <form action="" method="">
                                <input type="submit" value="Supprimer">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h4>Aucune registration</h4>
        @endif
    </div>

@endsection
