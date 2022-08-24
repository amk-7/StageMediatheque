@extends("layout.base")

@section("content")
    <main>
        <h1> Livre : {{$livreNumerique->ouvrageNumerique->ouvrage->titre }}</h1>
        <div class="image_livre">
            <img src="" alt="image du livre">
        </div>
        <div class="informations_livre">
            <label>Titre : {{$livreNumerique->ouvrageNumerique->ouvrage->titre }} </label><br>
            <label>Auteurs :  </label><br>
            <label>Lieu d'édition :  </label><br>
            <label>Année d'édition :  </label><br>
            <label>Niveau : {{ $livreNumerique->ouvrageNumerique->ouvrage->niveau }} </label><br>
            <label>Type : {{ $livreNumerique->ouvrageNumerique->ouvrage->type }} </label><br>
            <label>Domaine : {{ $livreNumerique->categorie }} </label><br>
            <label>ISBN : {{ $livreNumerique->ISBN }} </label><br>
            <label>Langue : {{ $livreNumerique->ouvrageNumerique->ouvrage->langue }} </label><br>
            <label>url : {{ $livreNumerique->url }} </label><br>
            <label>La cote : </label><br>
        </div>
        <div>
            <form action="{{route('formulaireEnregistrementLivreNumerique')}}" method="get">
                @csrf
                <input type="submit" name="retour" value="Retour">
            </form>
            <form action="" method="get">
                @csrf
                <input type="submit" name="suivant" value="suivant">
            </form>
        </div>
    </main>