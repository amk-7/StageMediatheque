<form class="flex flex-col items-center">
    <div class="">
        <div class="flex flex-row w-96">
            <input name="search" class="search w-5/6" type="search" name="search_by" id="search_by" placeholder="rechercher par titre, ISBM ou mot cle">
            <button type="submit" class="button button_primary w-1/6">
                <img src="{{ asset('storage/images/search.png') }}" class="block h-auto w-auto fill-current text-gray-600">
            </button>
        </div>
    </div>
    <div class="flex flex-col items-center m-auto" id="searchParametersField">
        <div>
            <p class="m-3 text-2xl">Paramètres de recherche </p>
        </div>
        <div class="m-3 md:flex md:space-x-3">
            <div class="flex space-x-3">
                <select id="min" class="select_btn w-1/2 mb-3">
                    <option value=""> Début </option>
                    @for($a=date('Y'); $a >= $annees; $a--)
                        <option value="{{ $a }}"> {{ $a }} </option>
                    @endfor
                </select>
                <select id="max" class="select_btn w-1/2 mb-3" style="">
                    <option value=""> Fin </option>
                    @for($a=date('Y'); $a >= $annees; $a--)
                        <option value="{{ $a }}"> {{ $a }} </option>
                    @endfor
                </select>
            </div>
            <div class="flex space-x-3">
                <select id="langue" class="select_btn w-full mb-3">
                    <option value="">Toute langues</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->libelle }}"> {{ $langue->libelle }} </option>
                    @endforeach
                </select>
                <select id="type" class="select_btn w-full mb-3">
                    <option value="">Tous types</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id_type_ouvrage }}"> {{ $type->libelle }} </option>
                    @endforeach
                </select>
            </div>
            <div class="flex space-x-3">
                <select id="domaine" class="select_btn w-full mb-3">
                    <option value="">Tous domaines</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->libelle }}"> {{ $categorie->libelle }} </option>
                    @endforeach
                </select>
                <select id="niveau" class="select_btn w-full mb-3">
                    <option value="">Tous niveaus</option>
                    @foreach($niveaus as $niveau)
                        <option value="{{ $niveau->id_niveau }}" > {{ $niveau->libelle }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>
