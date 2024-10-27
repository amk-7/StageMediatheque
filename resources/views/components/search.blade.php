<form class="flex flex-col items-center space-y-3" id="form">
    <div class="w-96 lg:w-[800px]">
        <div class="flex flex-row w-full border border-green-500">
            <input name="search" class="w-10/12 lg:w-11/12 border border-none py-3" type="search" name="search_by" id="search_by" placeholder="rechercher par titre, ISBM ou mot cle" value="{{ $selected_search }}">
            <button type="submit" class="flex flex-col items-center justify-center w-2/12 lg:w-1/12">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="flex flex-col items-center m-auto" id="searchParametersField">
        <div class="m-3 md:flex md:space-x-3">
            <div class="flex space-x-3">
                <select id="min" name="min" class="select_btn w-1/2 mb-3">
                    <option value=""> Début </option>
                    @foreach($annees as $annee)
                        <option value="{{ $annee }}" {{ $selected_min==$annee ? "selected" : "" }} > {{ $annee }} </option>
                    @endforeach
                </select>
                <select id="max" name="max" class="select_btn w-1/2 mb-3" style="">
                    <option value=""> Fin </option>
                    @foreach($annees as $annee)
                        <option value="{{ $annee }}" {{ $selected_max==$annee ? "selected" : "" }} > {{ $annee }} </option>
                    @endforeach
                </select>
            </div>
            <div class="flex space-x-3">
                <select id="langue" name="langue" class="select_btn w-full mb-3">
                    <option value="">Toute langues</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->libelle }}" {{ $selected_langue==$langue->libelle ? "selected" : "" }}> {{ $langue->libelle }} </option>
                    @endforeach
                </select>
                <select id="type" name="type" class="select_btn w-full mb-3">
                    <option value="">Tous types</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id_type_ouvrage }}" {{ $selected_type==$type->id_type_ouvrage ? "selected" : "" }}> {{ $type->libelle }} </option>
                    @endforeach
                </select>
            </div>
            <div class="flex space-x-3">
                <select id="domaine" name="domaine" class="select_btn w-full mb-3">
                    <option value="">Tous domaines</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->libelle }}" {{ $selected_domaine==$categorie->libelle ? "selected" : "" }}> {{ $categorie->libelle }} </option>
                    @endforeach
                </select>
                <select id="niveau" name="niveau" class="select_btn w-full mb-3">
                    <option value="">Tous niveaus</option>
                    @foreach($niveaus as $niveau)
                        <option value="{{ $niveau->id_niveau }}"  {{ $selected_niveau==$niveau->id_niveau ? "selected" : "" }} > {{ $niveau->libelle }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>
