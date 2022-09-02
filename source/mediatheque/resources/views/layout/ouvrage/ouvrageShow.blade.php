@extends("layout.base")
@section("content")
    <main>
        <h1>Livre : {{$ouvrage->titre }}</h1>
        <div class="image_livre">
            <img src="{{ asset('storage/images/images_livre/'.$ouvrage->image) }}"
                 alt="{{$ouvrage->image}}"/>
        </div>
        <div class="informations_livre">
            <label>Titre : {{$ouvrage->titre }} </label><br>
            <label>Auteurs
                : {{ \App\Helpers\OuvrageHelper::afficherAuteurs( $ouvrage) }} </label><br>
            <label>Lieu d'édition
                : {{ $ouvrage->auteurs->first()->pivot->lieu_edition }} </label><br>
            <label>Année d'édition
                : {{ $ouvrage->auteurs->first()->pivot->annee_apparution }} </label><br>
            <label>Niveau : {{ $ouvrage->niveau }} </label><br>
            <label>Type : {{ $ouvrage->type }} </label><br>
            @yield('particularite')
            <label>Langue : {{ $ouvrage->langue }} </label><br>
            <label>Mots clè : {{ \App\Helpers\LivrePapierHelper::showArray($ouvrage->mot_cle, "mot_cle_") }} </label><br>
            @yield('stock')
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
