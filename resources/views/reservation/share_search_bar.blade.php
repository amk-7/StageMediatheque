<form method="get" action="" class="mt-8">
    <div class="flex flex-row space-x-3">
        @yield('etat')
        @if(! Auth::user()->hasRole('abonne'))
            <select name="nom_abonne" id="nom_abonnes" class="select_btn w-full">
                <option>Séléctionner nom</option>
            </select>
            <select name="prenom_abonne" id="prenom_abonnes" class="select_btn w-full">
                <option>Séléctionner prénom</option>
            </select>
        @endif
        <input type="submit" value="rechercher" class="button button_primary">
    </div>
</form>
