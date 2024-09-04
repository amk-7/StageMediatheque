@extends('layouts.app')
@section('content')
<div class="flex flex-col text-center">
    <h1 class="label_title">Liste des restitutions</h1>
    <div>
        <form class="flex flex-col items-center mb-12" method="get" action="{{route('restitutions.index')}}">
            <div class="flex space-x-3">
                <div>
                    <select name="etat" class="select_btn">
                        <option value="">Etat</option>
                        <option value="0">Partiel</option>
                        <option value="1">Complet</option>
                    </select>
                </div>
                <div class="flex flex-row w-96">
                    <input class="search w-5/6" type="search" name="search_by" id="search_by" placeholder="rechercher par nom, prénom">
                    <button type="submit" class="button button_primary w-1/6">
                        <img src="{{ asset('storage/images/search.png') }}" class="block h-auto w-auto fill-current text-gray-600">
                    </button>
                </div>
            </div>
        </form>
        @if(! empty( $restitutions ?? "") && $restitutions->count() > 0)
        <table class="fieldset_border bg-white">
            <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                <tr>
                    <th class="fieldset_border">Numer</th>
                    <th class="fieldset_border">Nombre ouvrage</th>
                    <th class="fieldset_border">Abonne</th>
                    <th class="fieldset_border">Personnel</th>
                    <th class="fieldset_border">Etat</th>
                    <th class="fieldset_border">Date</th>
                    <th class="fieldset_border">Editer</th>
                </tr>
            </thead>
            <tbody>
                @php
                $etatB = $etat=="1" ? true : false ;
                @endphp
                @foreach($restitutions as $restitution)
                @if(str_contains(strtolower($restitution->abonne->utilisateur->userFullName), strtolower($search_by) ?? ""))
                @if($etat==null ? true : false || $restitution->etat == $etatB)
                <tr class="fieldset_border">
                    <td class="fieldset_border"> {{ $restitution->id_restitution }} </td>
                    <td class="fieldset_border"> {{ $restitution->nombreOuvrages }} </td>
                    <td class="fieldset_border"> {{ $restitution->abonne->utilisateur->userFullName }} </td>
                    <td class="fieldset_border"> {{ $restitution->personnel->utilisateur->userFullName }} </td>
                    <td class="fieldset_border">
                        @if ($restitution->etat)
                        <span class="info"> Complet </span>
                        @else
                        <span class="alert"> Partiel </span>
                        @endif
                    </td>
                    <td class="fieldset_border"> {{ $restitution->date_restitution }} </td>
                    <td class="fieldset_border">
                        <form action="{{ route('restitutions.edit', $restitution) }}" method="get">
                            @if ($restitution->etat)
                            <input type='submit' value='Consulter' class='button button_show'>
                            @else
                            <input type='submit' value='Editer' class='button button_primary'>
                            @endif
                        </form>
                    </td>
                </tr>
                @endif
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-8">
        {!! $restitutions->links() !!}
    </div>
    @else
    <h2>Aucune restitution.</h2>
    @endif
</div>
@stop