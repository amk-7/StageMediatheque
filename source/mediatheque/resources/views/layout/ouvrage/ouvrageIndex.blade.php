@extends('layout.base')
@section('content')
    <h1>{{$title}}</h1>
    <table border="1">
        <thead>
            <th>Image</th>
            <th>Titre</th>
            <th>Niveau</th>
            <th>Type</th>
            <th>Domaine</th>
            <th>ISBN</th>
            <th>Langue</th>
            @yield("thead_content_ouvrage_physique")
            <th>Éditer</th>
            <th>Supprimer</th>
        </thead>
        <tbody>
            @foreach($livresPapier as $livrePapier)
                <tr>
                    <td> <img src="" alt="image du livre"> </td>
                    <td> {{ $livrePapier->ouvragePhysique->ouvrage->titre }} </td>
                    <td> {{ $livrePapier->ouvragePhysique->ouvrage->niveau }} </td>
                    <td> {{ $livrePapier->ouvragePhysique->ouvrage->type }} </td>
                    <td> {{ $livrePapier->categorie }} </td>
                    <td> {{ $livrePapier->ISBN }} </td>
                    <td> {{ $livrePapier->ouvragePhysique->ouvrage->langue }} </td>
                    <td> {{ $livrePapier->ouvragePhysique->nombre_exemplaire }} </td>
                    <td> {{ $livrePapier->ouvragePhysique->etat }} </td>
                    <td> {{ $livrePapier->ouvragePhysique->disponibilite }} </td>
                    <td>
                        <form action="" method="get">
                            @csrf
                            <input type="submit" name="editer" value="Éditer">
                        </form>
                    </td>
                    <td>
                        <form action="" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" name="supprimer" value="Supprimer">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
