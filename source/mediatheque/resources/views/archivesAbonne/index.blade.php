@extends('layout.template.base')
@section('content')
    <div class="flex flex-col justify-center items-center">
        <h1 class="label_title"> Archives des Abonnes </h1>
        <div class="ml-16">
            <table class="fieldset_border bg-white">
                <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                    <tr class="fieldset_border">
                    <th class="fieldset_border" >N°</th>
                        <th class="fieldset_border" >Profil</th>
                        <th class="fieldset_border" >Nom</th>
                        <th class="fieldset_border" >Prenom</th>
                        <th class="fieldset_border" >Email</th>
                        <th class="fieldset_border" >Contact</th>
                        <th class="fieldset_border" >Ville</th>
                        <th class="fieldset_border" >Profession</th>
                        <th class="fieldset_border" >Contact a prevenir</th>
                        <th class="fieldset_border" >Numero de Carte</th>
                        <th class="fieldset_border" >Type de Carte</th>
                        <th class="fieldset_border" >Profil valider</th>

                    </tr>
                </thead>
                <tbody>
                    
                    @forelse($archives as $archive)
                        
                        <tr class="fieldset_border">
                            <td class="fieldset_border" >{{$loop->index+1}}</td>
                            <td class="fieldset_border" ><img src="{{ asset('storage/images/image_utilisateur').'/'.$archive->utilisateur->photo_profil }}" alt="photo" class="w-10 h-10 rounded-full"></td>
                            <td class="fieldset_border" >{{ $archive->utilisateur->nom }}</td>
                            <td class="fieldset_border" >{{ $archive->utilisateur->prenom }}</td>
                            <td class="fieldset_border" >{{ $archive->utilisateur->email }}</td>
                            <td class="fieldset_border" >{{ $archive->utilisateur->contact }}</td>
                            <td class="fieldset_border" >{{ $archive->utilisateur->adresse["ville"] }}</td>
                            <td class="fieldset_border" >{{ $archive->profession }}</td>
                            <td class="fieldset_border" >{{ $archive->contact_a_prevenir }}</td>
                            <td class="fieldset_border" >{{ $archive->numero_carte }}</td>
                            <td class="fieldset_border" >{{ $archive->type_de_carte }}</td>
                            <td class="fieldset_border" >{{ $archive->profil_valider }}</td>
                            
                        </tr>
                    @empty
                        <span>Aucune archive n'a été trouvé</span>
                    @endforelse
                </tbody>
            </table>
            {{ $archives->links() }}
                    
                       
        </div>
    </div>
@stop