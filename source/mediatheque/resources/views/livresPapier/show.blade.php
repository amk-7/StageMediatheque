@extends("layout.base")

@section("content")
    <main>
        <h1>Livre : {{$livrePapier->ouvragePhysique->ouvrage->titre }}</h1>
        <div class="image_livre">
            <img src="{{ asset('storage/images/images_livre/'.$livrePapier->ouvragePhysique->ouvrage->image) }}"
                 alt="{{$livrePapier->ouvragePhysique->ouvrage->image}}"/>
        </div>
        <div class="informations_livre">
            <label>Titre : {{$livrePapier->ouvragePhysique->ouvrage->titre }} </label><br>
            <label>Auteurs
                : {{ \App\Helpers\OuvrageHelper::afficherAuteurs( $livrePapier->ouvragePhysique->ouvrage) }} </label><br>
            <label>Lieu d'édition
                : {{ $livrePapier->ouvragePhysique->ouvrage->auteurs->first()->pivot->lieu_edition }} </label><br>
            <label>Année d'édition
                : {{ $livrePapier->ouvragePhysique->ouvrage->auteurs->first()->pivot->annee_apparution }} </label><br>
            <label>Niveau : {{ $livrePapier->ouvragePhysique->ouvrage->niveau }} </label><br>
            <label>Type : {{ $livrePapier->ouvragePhysique->ouvrage->type }} </label><br>
            <label>Domaine
                : {{ \App\Helpers\LivrePapierHelper::showArray($livrePapier->categorie, "categorie") }} </label><br>
            <label>ISBN : {{ $livrePapier->ISBN }} </label><br>
            <label>Langue : {{ $livrePapier->ouvragePhysique->ouvrage->langue }} </label><br>
            <label>Nombre d'exemplaire : {{ $livrePapier->ouvragePhysique->nombre_exemplaire }} </label><br>
            <label>Etat : {{ $livrePapier->ouvragePhysique->etat }} </label><br>
            <label>Disponibilité
                : {{ \App\Helpers\OuvragesPhysiqueHelper::formatAvaible($livrePapier->ouvragePhysique) }} </label><br>
            <label>La cote : </label><br>
            <label>Mots clè
                : {{ \App\Helpers\LivrePapierHelper::showArray($livrePapier->ouvragePhysique->ouvrage->mot_cle, "mot_cle_") }} </label><br>
            <label>Rayon
                : {{ $livrePapier->ouvragePhysique->classificationDeweyDizaine->first()->classificationDeweyCentaine->theme }}</label><br>
            <label>Etager : {{ $livrePapier->ouvragePhysique->classificationDeweyDizaine->first()->matiere }}</label>
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
