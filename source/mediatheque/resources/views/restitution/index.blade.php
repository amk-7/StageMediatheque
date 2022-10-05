@extends('layout.template.base')
@section('content')
    <div class="flex flex-col text-center">
        <h1 class="label_title">Liste des restitutions</h1>
        <div>
            <!--div class="">
                <form>
                    <input type="submit" value="Ajouter">
                </form>
            </div-->
            @if(! empty( $restitutions ?? "") && $restitutions->count() > 0)
                <table class="fieldset_border bg-white">
                    <thead class="fieldset_border">
                    <tr>
                        <th class="fieldset_border" >Numer</th>
                        <th class="fieldset_border" >Nombre ouvrage</th>
                        <th class="fieldset_border" >Abonne</th>
                        <th class="fieldset_border" >Personnel</th>
                        <th class="fieldset_border" >Etat</th>
                        <th class="fieldset_border" >Date</th>
                        <th class="fieldset_border" >Editer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($restitutions as $restitution)
                        <tr class="fieldset_border" >
                            <td class="fieldset_border" > {{ $restitution->id_restitution }} </td>
                            <td class="fieldset_border" > {{ $restitution->nombreOuvrages }} </td>
                            <td class="fieldset_border" > {{ $restitution->abonne->utilisateur->userFullName }} </td>
                            <td class="fieldset_border" > {{ $restitution->personnel->utilisateur->userFullName }} </td>
                            {!! \App\Helpers\RestitutionHelper::afficherEtatREstitution($restitution)  !!}
                            <td class="fieldset_border" > {{ $restitution->date_restitution }} </td>
                            <td class="fieldset_border" >
                                <form action="{{ route('formulaireModificationRestitution', $restitution) }}" method="get">
                                    {!! \App\Helpers\RestitutionHelper::afficherBtn($restitution)  !!}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
        @else
            <h2>Aucune restitution.</h2>
        @endif
    </div>
@stop
