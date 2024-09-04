@extends('layouts.app')
@section('content')
    <div class="flex flex-col justify-center items-center w-full ml-28 mx-12 space-y-6">
        <h1 class="text-3xl">  Liste des Abonements </h1>
        <div class="space-y-3 w-full">
            <form class="flex flex-col items-center" method="get" action="">
                <div class="w-96 lg:w-[800px] space-y-3">
                    <div class="flex flex-row w-full border border-green-500">
                        <input class="w-10/12 lg:w-11/12 border border-none py-3" type="text" name="search" id="search" placeholder="rechercher par nom, prénom" value="{{ old('selected_search_by') }}">
                        <button type="submit" class="flex flex-col items-center justify-center w-2/12 lg:w-1/12">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </button>
                    </div>
                    <div class="" id="searchParametersField">
                        <p>Paramètres de recherche</p>
                        <div class="flex space-x-3">
                            <select id="min" name="min_annee" class="select_btn w-1/3 mb-3">
                                <option value=""> Début </option>
                                @for($a=$min_annee; $a <= $max_annee; $a++)
                                    <option value="{{ $a }}" {{ $selected_min==$a ? "selected" : "" }} > {{ $a }} </option>
                                @endfor
                            </select>
                            <select id="max" name="max_annee" class="select_btn w-1/3 mb-3" style="">
                                <option value=""> Fin </option>
                                @for($a=$max_annee; $a >= $min_annee; $a--)
                                    <option value="{{ $a }}" {{ $selected_max==$a ? "selected" : "" }} > {{ $a }} </option>
                                @endfor
                            </select>
                            <select name="etat" class="select_btn w-1/3 mb-3">
                                <option value="" {{ $selected_etat=="" ? "selected" : "" }}>Tous</option>
                                <option value="1" {{ $selected_etat=="1" ? "selected" : "" }}>Activer</option>
                                <option value="0" {{ $selected_etat=="0" ? "selected" : "" }}>Desactiver</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="flex justify-between">
                <div>
                    <form method="GET" action="{{route('createLiquide')}}" class="mb-3">
                        @csrf
                        <button type="Submit" class="button button_primary">Faire un abonement</button>
                    </form>
                    <form method="GET" action="{{ route('exporter_abonnements') }}" class="mb-3">
                        @csrf
                        <button type="Submit" class="button button_show">Imprimer</button>
                    </form>
                </div>
                <form method="POST" action="" class="mb-3">
                    @method('delete')
                    @csrf
                    <button type="Submit" class="button button_delete" onclick="activeModal('-')">Annuler abonement</button>
                </form>
            </div>
            <div class="w-full">
                <table class="bg-white w-full">
                    <thead class="text-xs uppercase bg-gray-200 dark:bg-gray-300 dark:text-gray-500 text-left">
                        <tr class="fieldset_border w-full">
                        <th class="fieldset_border">Abonne</th>
                            <th class="fieldset_border">Tarif</th>
                            <th class="fieldset_border">Date debut</th>
                            <th class="fieldset_border">Date fin</th>
                            <th class="fieldset_border">Etat</th>
                            <th class="fieldset_border">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="">
                    @forelse($liquides as $liquide)
                        <tr class="fieldset_border">
                        <td class="fieldset_border"> {{ $liquide->registration->abonne->utilisateur->userFullName }} </td>
                            <td class="fieldset_border"> {{ $liquide->registration->tarifAbonnement->designation }} </td>
                            <td class="fieldset_border"> {{ $liquide->registration->date_debut->format('Y-m-d') }} </td>
                            <td class="fieldset_border"> {{ $liquide->registration->date_fin->format('Y-m-d') }} </td>
                            <td class="fieldset_border">
                                @if ($liquide->registration->etat==0)
                                    <span class="alert">Expiré</span>
                                @else
                                    <span class="info">Actif</span>
                                @endif
                            </td>
                            <td class="fieldset_border">
                                <input type="button" onclick="activeModal('{{$liquide->id_liquide}}')" value="Annuler" class="button button_delete">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="fieldset_border">
                            Aucun abonnement n'est enregistré
                            </td>
                            <td class="fieldset_border">
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-full">
            {{ $liquides->links() }}
        </div>
@endsection
@if (session('success'))
@section('js')
    <script>
        AlertSwalInfo(title='Info', text="{!! session('success') !!}", icon='success');
    </script>
@endsection
@endif
@if (session('error'))
@section('js')
    <script>
        AlertSwalInfo(title='Info', text="{!! session('error') !!}", icon='error');
    </script>
@endsection
@endif
