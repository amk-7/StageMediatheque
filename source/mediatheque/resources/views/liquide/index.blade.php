@extends('layout.template.base')

@section('content')
    <div class="flex flex-col justify-center items-center m-auto">
        <h1 class="text-3xl"> Liste des Abonements </h1>
        <div>
            <form method="GET" action="{{route('createLiquide')}}" class="mb-3">
                <button type="Submit" class="button button_primary">Faire un abonement</button>
            </form>
            @if(!empty($liquides ?? "") && $liquides->count() > 0)
                <table class="fieldset_border bg-white">
                    <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                        <tr class="fieldset_border">
                            <th class="fieldset_border">Abonne</th>
                            <th class="fieldset_border">Tarif</th>
                            <th class="fieldset_border">Date debut</th>
                            <th class="fieldset_border">Date fin</th>
                            <th class="fieldset_border">Etat</th>
                            <th class="fieldset_border">Consulter</th>
                        </tr>
                    </thead>
                    <tbody class="fieldset_border">
                    @foreach($liquides as $liquide)
                        <tr class="fieldset_border">
                            <td class="fieldset_border"> {{ $liquide->registration->abonne->utilisateur->userFullName }} </td>
                            <td class="fieldset_border"> {{ $liquide->registration->tarifAbonnement->designation }} </td>
                            <td class="fieldset_border"> {{ $liquide->registration->date_debut->format('Y-m-d') }} </td>
                            <td class="fieldset_border"> {{ $liquide->registration->date_fin->format('Y-m-d') }} </td>
                            {!! \App\Helpers\UtilisateurHelper::showRegistrationState($liquide->registration) !!}
                            <td class="fieldset_border">
                                <form action="" method="">
                                    <input type="submit" value="Consulter" class="button button_show">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h4>Aucun abonnement</h4>
            @endif
        </div>
        {{ $liquides->links() }}
    </div>

@endsection
