@extends('layout.template.base')

@section('content')
    <div class="flex flex-col justify-center items-center">
        <h1 class="label_title"> Liste des Emprunts </h1>
        <div class="space-y-2">
            @if(!empty($emprunts ?? "") && $emprunts->count() > 0)
                <div>
                    <form method="GET" action="{{route('createEmprunt')}}">
                        <button type="Submit" class="button button_primary">Ajouter</button>
                    </form>
                </div>
                <table border="1" class="fieldset_border">
                    <thead class="thead">
                    <tr class="fieldset_border">
                        <th class="fieldset_border" >Numéro</th>
                        <th class="fieldset_border" >Date de l'emprunt</th>
                        <th class="fieldset_border" >Nombre Ouvrage</th>
                        <th class="fieldset_border" >Date de retour</th>
                        <th class="fieldset_border" >Abonné</th>
                        <th class="fieldset_border" >personnel</th>
                        <th class="fieldset_border" >Consulter</th>
                        <th class="fieldset_border" >Editer</th>
                        <th class="fieldset_border" >Restituer</th>
                        <th class="fieldset_border" >Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($emprunts as $emprunt)
                        <tr class="fieldset_border" >
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
                                <form action="{{route('editEmprunt', $emprunt)}}" method="get">
                                    <input type="submit" class="button button_primary" value="Editer">
                                </form>
                            </td>
                            <td class="fieldset_border">
                                <!-- Verifier si l'emprunt à été déjà restituer -->
                                <form action="{{ route('formulaireEnregistrementRestitution', $emprunt) }}" method="get">
                                    @csrf
                                    <input type="submit" class="button button_primary" value="Restituer" {{ \App\Service\EmpruntService::etatEmprunt($emprunt) }}>
                                </form>
                            </td>
                            <td class="fieldset_border">
                                <form action="{{ route('destroyEmprunt', $emprunt) }}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" class="button button_delete" value="Supprimer">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h4>Aucun emprunt</h4>
            @endif
        </div>
    </div>
@endsection
