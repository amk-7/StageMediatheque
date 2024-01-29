@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center items-center m-auto">
        <h1 class="label_title"> Liste de mes emprunts </h1>
        <div class="space-y-2">
            @if(!empty($emprunts ?? "") && $emprunts->count() > 0)
                <div class="overflow-x-auto my_content2">
                    <table border="1" class="fieldset_border w-full">
                        <thead class="thead">
                        <tr class="fieldset_border">
                            <th class="fieldset_border" >Numéro</th>
                            <th class="fieldset_border" >Date de l'emprunt</th>
                            <th class="fieldset_border" >Nombre Ouvrage</th>
                            <th class="fieldset_border" >Date de retour</th>
                            <th class="fieldset_border" >Abonné</th>
                            <th class="fieldset_border" >personnel</th>
                            <th class="fieldset_border" >Consulter</th>
                            <th class="fieldset_border" >Etat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($emprunts as $emprunt)
                            <tr class="fieldset_border">
                                <td class="fieldset_border" > {{ $emprunt->id_emprunt }} </td>
                                <td class="fieldset_border" > {{ $emprunt->date_emprunt->format('Y-m-d') }} </td>
                                <td class="fieldset_border" > {{ $emprunt->nombreOuvrageEmprunte }} </td>
                                <td class="fieldset_border" > {{ $emprunt->date_retour->format('Y-m-d') }} </td>
                                <td class="fieldset_border" > {{ $emprunt->abonne->utilisateur->userFullName ?? "" }} </td>
                                <td class="fieldset_border" > {{ $emprunt->personnel->utilisateur->userFullName ?? "" }} </td>
                                <td class="fieldset_border" >
                                    <form action="{{ route('showEmprunt', $emprunt)}}" method="get">
                                        <input type="submit" class="button button_show" value="Consulter">
                                    </form>
                                </td>
                                <td class="fieldset_border" >
                                    @if($emprunt->etatEmprunt())
                                        ✅
                                    @else
                                        ️❌
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h4>Aucun emprunt</h4>
            @endif
        </div>
    </div>
@endsection
