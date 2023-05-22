@extends('layout.template.base')
@section('content')
    <div class="flex flex-col justify-center items-center">
        <h1 class="label_title"> Archives des Livres Papier </h1>
        <div class="ml-16">
            <table class="fieldset_border bg-white">
                <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                    <tr class="fieldset_border">
                        <th class="fieldset_border" >N°</th>
                        <th class="fieldset_border" >ISBN</th>
                        <th class="fieldset_border" >Ouvrage Physique</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @forelse($archiveLivresPapiers as $archiveLivrePapier)
                        <tr class="fieldset_border">
                            <td class="fieldset_border" >{{$loop->index+1}}</td>
                            <td class="fieldset_border" >{{ $archiveLivrePapier->isbn }}</td>
                            <td class="fieldset_border" >{{ $archiveLivrePapier->id_ouvrage_physique }}</td>
                        </tr>
                    @empty
                        <span>Aucune archive n'a été trouvé</span>
                    @endforelse
                </tbody>
            </table>
            {{ $archiveLivresPapiers->links() }}

        </div>
    </div>
@stop