@extends("layouts.app")

@section("content")
    <div class="flex flex-col justify-center items-center space-y-3">
        <form action="{{route('emprunts.update', $emprunt)}}" method="post" class="flex flex-col p-6 space-y-3 bg-white">
            @csrf
            <h1 class="label_title text-center" >Editer l'emprunt N° {{ $emprunt->id_emprunt }}</h1>
            {{ method_field('PUT') }}
            <fieldset class="fieldset_border">
                <legend>Personnel</legend>
                <div class="">
                    <label for="nom" class="">Nom</label>
                    <select name="nom" id="nom_personnes" class="select_btn"></select>
                </div>
                <div class="alert">
                    <p id="nom_erreur" hidden>Vous devez séléctionner le nom</p>
                </div>
                <div>
                    <label for="prenom">Prenom</label>
                    <select name="prenom" id="prenom_personnes" class="select_btn" >
                        <option>Séléctionner prénom</option>
                    </select>
                </div>
                <div class="alert">
                    <p id="prenom_erreur" hidden>Vous devez séléctionner le prenom</p>
                </div>
            </fieldset>
            <fieldset class="fieldset_border">
                <legend>Abonné</legend>
                <div>
                    <label for="nom_abonnee">Nom</label>
                    <select name="nom_abonne" id="nom_abonnes" class="select_btn" ></select>
                </div>
                <div class="alert">
                    <p id="nom_abonne_erreur" hidden>Vous devez séléctionner le nom</p>
                </div>
                <div>
                    <label for="prenom_abonne">Prenom</label>
                    <select name="prenom_abonne" id="prenom_abonnes" class="select_btn">
                        <option>Séléctionner prénom</option>
                    </select>
                </div>
                <div class="alert">
                    <p id="prenom_abonne_erreur" hidden>Vous devez séléctionner le prenom</p>
                </div>
            </fieldset>
            <fieldset class="fieldset_border">
                <legend>Duree emprunt</legend>
                <div class="flex items-center">
                    <label for="date_emprunt" class="w-3/5">Date Emprunt</label>
                    <input type="date" name="date_emprunt" id="date_emprunt" class="input w-2/5"
                           value="{{ date_format($emprunt->date_emprunt, 'Y-m-d') }}" disabled>
                </div>
                <div>
                    <label for="duree_emprunt">Duree Emprunt</label>
                    <select name="duree_emprunt" id="duree_emprunt" class="select_btn">
                        <option>Sélectionner durée</option>
                        @for($i=1; $i<=4; $i++)
                            <option value="{{$i}}" {{ $i == 2 ? "selected" : "" }} > {{$i}} Semaines</option>
                        @endfor
                    </select>
                </div>
            </fieldset>
            <div class="m-3">
                <div>
                    <button name="modifier_emprunt" id="modifier_emprunt" class="button button_primary w-full">Modifier</button>
                </div>
            </div>
        </form>
    </div>
@stop




