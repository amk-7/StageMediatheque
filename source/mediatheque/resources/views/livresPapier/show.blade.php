@extends("layout.base")

@section("content")
    <main>
        <h1>Livre : {{$livrePapier->ouvragePhysique->ouvrage->titre }}</h1>
        <div class="image_livre">
            <img src="" alt="image du livre">
        </div>
        <div class="informations_livre">
            <label>Titre : {{$livrePapier->ouvragePhysique->ouvrage->titre }} </label><br>
            <label>Auteurs :  </label><br>
            <label>Lieu d'édition :  </label><br>
            <label>Année d'édition :  </label><br>
            <label>Niveau : {{ $livrePapier->ouvragePhysique->ouvrage->niveau }} </label><br>
            <label>Type : {{ $livrePapier->ouvragePhysique->ouvrage->type }} </label><br>
            <label>Domaine : {{ $livrePapier->categorie }} </label><br>
            <label>ISBN : {{ $livrePapier->ISBN }} </label><br>
            <label>Langue : {{ $livrePapier->ouvragePhysique->ouvrage->langue }} </label><br>
            <label>Nombre d'exemplaire : {{ $livrePapier->ouvragePhysique->ouvrage->nombre_exemplaire }} </label><br>
            <label>Etat : {{ $livrePapier->ouvragePhysique->ouvrage->etat }} </label><br>
            <label>Disponibilité : {{ $livrePapier->ouvragePhysique->ouvrage->disponibilite }} </label><br>
            <label>La cote : </label><br>
        </div>
        <div>
            <form action="{{route('formulaireEnregistrementLivrePapier')}}" method="get">
                @csrf
                <input type="submit" name="retour" value="Retour">
            </form>
            <form action="" method="get">
                @csrf
                <input type="submit" name="suivant" value="suivant">
            </form>
        </div>
    </main>
@stop
