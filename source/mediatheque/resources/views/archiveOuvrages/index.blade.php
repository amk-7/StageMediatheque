@extends('layout.template.base')
@section('content')
    <div class="flex flex-col justify-center items-center">
        <h1 class="label_title"> Archives des ouvrages </h1>
        <div class="ml-16">
            <table class="fieldset_border bg-white">
                <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                    <tr class="fieldset_border">
                        <th class="fieldset_border" >Numero</th>
                        <th class="fieldset_border" >Titre</th>
                        <th class="fieldset_border" >Année apparution</th>
                        <th class="fieldset_border" >Niveau</th>
                        <th class="fieldset_border" >Type</th>
                        <th class="fieldset_border" >language</th>
                        <th class="fieldset_border" >Lieu d'édition</th>

                    </tr>
                </thead>
                <tbody>
                    
                    @forelse($archiveOuvrages as $archiveOuvrage)
                        <tr class="fieldset_border">
                            <td class="fieldset_border" >{{$loop->index+1}}</td>
                            <td class="fieldset_border" >{{ $archiveOuvrage->titre }}</td>
                            <td class="fieldset_border" >{{ $archiveOuvrage->annee_apparution }}</td>
                            <td class="fieldset_border"> {{ \App\Helpers\OuvrageHelper::afficherNiveau($archiveOuvrage->niveau) }}</td>
                            <td class="fieldset_border" >{{ $archiveOuvrage->type }}</td>
                            <td class="fieldset_border" >{{ $archiveOuvrage->langue }}</td>
                            <td class="fieldset_border" >{{ $archiveOuvrage->lieu_edition }}</td>
                        </tr>
                    @empty
                        <span>Aucune archive n'a été trouvé</span>
                    @endforelse
                </tbody>
            </table>
            {{ $archiveOuvrages->links() }}

        </div>
    </div>
@stop


    