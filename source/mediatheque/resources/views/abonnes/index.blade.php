<?php ?>

<h1 class="label_title">Liste des Abonnes</h1>
<form method="GET" action="{{route('createAbonne')}}">
    <button class="select_btn" type="Submit">Ajouter un Abonne</button>
</form>
<div>
    <table class="w-full text-sm text-left text-dark">
        <caption class="button_show">Informations sur les Abonnes</caption>
        <tr>
            <th class="fieldset_border">Identifiant de l'utilisateur</th>
            <th class="fieldset_border">Photo de profil</th>
            <th class="fieldset_border">Nom</th>
            <th class="fieldset_border">Prenom</th>
            <th class="fieldset_border">Nom d'utilisateur</th>
            <th class="fieldset_border">Email</th>
            <th class="fieldset_border">Contact</th>
            <th class="fieldset_border">Ville</th>
            <th class="fieldset_border">Quartier</th>
            <th class="fieldset_border">Numero de maison</th>
            <th class="fieldset_border">Sexe</th>
            <th class="fieldset_border">Date Naissance</th>
            <th class="fieldset_border">Niveau Etude</th>
            <th class="fieldset_border">Profession</th>
            <th class="fieldset_border">Contact a prevenir</th>
            <th class="fieldset_border">Numero de Carte</th>
            <th class="fieldset_border">Type de Carte</th>
            <th class="fieldset_border">Mofier</th>
            <th class="fieldset_border">Afficher</th>
            <th class="fieldset_border">Supprimer</th>
        </tr>
    @forelse ($listeAbonnes as $abonne)
    {{--dd($abonne->date_naissance->format('d/m/Y'))--}}
            <tr>
                <td>{{$abonne->utilisateur->id_utilisateur}}</td>
                <td><img src="{{asset('storage/images/image_utilisateur').'/'.$abonne->utilisateur->photo_profil}}" width="80" height="80"></td>
                <td>{{$abonne->utilisateur->nom}}</td>
                <td>{{$abonne->utilisateur->prenom}}</td>
                <td>{{$abonne->utilisateur->nom_utilisateur}}</td>
                <td>{{$abonne->utilisateur->email}}</td>
                <td>{{$abonne->utilisateur->contact}}</td>
                <td>{{$abonne->utilisateur->adresse["ville"]}}</td>
                <td>{{$abonne->utilisateur->adresse["quartier"]}}</td>
                <td>{{$abonne->utilisateur->adresse["numero_maison"]}}</td>
                <td>{{$abonne->utilisateur->sexe}}</td>
                <td>{{$abonne->date_naissance->format('d/m/Y')}}</td>
                <td>{{$abonne->niveau_etude}}</td>
                <td>{{$abonne->profession}}</td>
                <td>{{$abonne->contact_a_prevenir}}</td>
                <td>{{$abonne->numero_carte}}</td>
                <td>{{$abonne->type_de_carte}}</td>
                <td>
                    <form method="GET" action="{{route('editAbonne', $abonne->id_abonne)}}">
                        <button class="button_edite" type="Submit">Modifier</button>
                    </form>
                </td>
                <td>
                    <form methode="GET" action="{{route('showAbonne', $abonne->id_abonne)}}">
                        <button class="button_show" type="Submit">Afficher</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{route('destroyAbonne', $abonne->id_abonne)}}">
                        @csrf
                        @method("DELETE")
                        <button class="button_delete" type="Submit">Supprimer</button>
                    </form>
                </td>
                </td>
            </tr>
    @empty
        <span>Aucun Abonne</span>
    @endforelse
    </table>

</div>

