@extends('layout.base')
@section('content')
    <h1> Livres papier </h1>
    <div>
        <td>
            <form action="{{route('formulaireEnregistrementLivrePapier')}}" method="get">
                @csrf
                <input type="submit" name="ajouter" value="ajouter">
            </form>
        </td>
    </div>
    @if(!empty($livresPapiers) && $livresPapiers->count())
        <table border="1">
            <thead>
                <th>Image</th>
                <th>Titre</th>
                <th>Niveau</th>
                <th>Type</th>
                <th>Domaine</th>
                <th>Langue</th>
                <th>Nombre d'exemplaire</th>
                <th>Etat</th>
                <th>Disponibilité</th>
                <th>ISBN</th>
                <th>Action</th>
            </thead>
            <tbody>
            @foreach($livresPapiers as $livresPapier)
                <tr>
                    <td> <img src="" alt="image du livre"> </td>
                    <td> {{ $livresPapier->ouvragePhysique->ouvrage->titre }} </td>
                    <td> {{ $livresPapier->ouvragePhysique->ouvrage->niveau }} </td>
                    <td> {{ $livresPapier->ouvragePhysique->ouvrage->type }} </td>
                    <td> {{ $livresPapier->categorie }} </td>
                    <td> {{ $livresPapier->ouvragePhysique->ouvrage->langue }} </td>
                    <td> {{ $livresPapier->ouvragePhysique->nombre_exemplaire }} </td>
                    <td> {{ $livresPapier->ouvragePhysique->etat }} </td>
                    <td> {{ $livresPapier->ouvragePhysique->disponibilite }} </td>
                    <!--td> {--{ \App\Helpers\OuvrageHelper::afficherAuteurs( $livresPapier->ouvragePhysique->ouvrage) }--} </td>
                    <td> {--{ $livresPapier->ouvragePhysique->ouvrage->auteurs->first()->pivot->lieu_edition }--} </td>
                    <td> {--{ $livresPapier->ouvragePhysique->ouvrage->auteurs->first()->pivot->annee_apparution }--} </td-->
                    <td> {{ $livresPapier->ISBN }} </td>
                    <!--td> {--{ $livresPapier->ouvragePhysique->ouvrage->mot_cle["mot_cle_0"] }--} </td-->
                    <td>
                        <form action="{{route('affichageLivrePapier', $livresPapier)}}" method="get">
                            @csrf
                            <input type="submit" name="consulter" value="Consulter">
                        </form>
                        <form action="{{route('formulaireModificationLivrePapier', $livresPapier)}}" method="get">
                            @csrf
                            <input type="submit" name="editer" value="Éditer">
                        </form>
                        <form action="{{route('suppressionLivrePapier', $livresPapier)}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" name="supprimer" value="Supprimer">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h3>Il n'y a aucun ouvrage.</h3>
    @endif
    {!! $livresPapiers->links() !!}
@stop
