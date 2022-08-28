@extends('layout.base')
@section("style")
    <style type="text/css">
        img {
            height: 3rem;
            width: 4rem;
        }
    </style>
@stop
@section('content')
    <h1> Livres papier </h1>
    <div>
        <form action="" method="">
            <ul id="searchModTabs">
                <li class="active">
                    <a class="change_search_mode" href="">Recherche génerale</a>
                </li>
                <li class="">
                    <a class="change_seache_mode" href="">Recherche plien text</a>
                </li>
            </ul>
            <div class="">
                <div class="input">
                    <input type="text"  name="search" id="searchFieldx" value="" placeholder="Recherche par titre, auteur, ISBN, éditeur, md5...">
                    <button type="submit">Rechercher</button>
                </div>
            </div>
            <div class="" id="searchParametersField">
                <p>Paramètre de recherche</p>
                <div>
                    <select name="annee_parution_debut">
                        <option value="all">Toute annee</option>
                    </select>
                    <select name="annee_parution_fin">
                        <option value="all">Toute annee</option>
                    </select>
                    <select name="langue">
                        <option value="all">Toute langue</option>
                    </select>
                    <select name="type">
                        <option value="all">Tous type</option>
                    </select>
                    <select name="domaine">
                        <option value="all">Tous domaine</option>
                    </select>
                    <select name="forme_ouvrage">
                        <option value="all">Toute forme</option>
                    </select>
                    <select name="nature_ouvrage">
                        <option value="all">Toute nature</option>
                    </select>
                    <select name="niveau">
                        <option value="all">Toute niveau</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div>
        <td>
            <form action="{{route('formulaireEnregistrementLivrePapier')}}" method="get">
                @csrf
                <input type="submit" name="ajouter" value="ajouter">
            </form>
        </td>
        <td>
            <form action="{{route('formulaireEnregistrementApprovisionnement')}}" method="get">
                @csrf
                <input type="submit" name="approvisionnement" value="Approvisionner">
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
                    <td> <img src="{{ asset('storage/images/images_livre/'.$livresPapier->ouvragePhysique->ouvrage->image) }}" alt="{{$livresPapier->ouvragePhysique->ouvrage->image}}"> </td>
                    <td> {{ $livresPapier->ouvragePhysique->ouvrage->titre }} </td>
                    <td> {{ $livresPapier->ouvragePhysique->ouvrage->niveau }} </td>
                    <td> {{ $livresPapier->ouvragePhysique->ouvrage->type }} </td>
                    <td> {{ \App\Helpers\LivrePapierHelper::showArray($livresPapier->categorie, "categorie") }} </td>
                    <td> {{ $livresPapier->ouvragePhysique->ouvrage->langue }} </td>
                    <td> {{ $livresPapier->ouvragePhysique->nombre_exemplaire }} </td>
                    <td> {{ \App\Helpers\OuvragePhysiqueHelper::afficherEtat($livresPapier->ouvragePhysique) }} </td>
                    <td> {{ \App\Helpers\OuvragePhysiqueHelper::formatAvaible($livresPapier->ouvragePhysique) }} </td>
                    <td> {{ $livresPapier->ISBN }} </td>
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
