<form wire:submit.prevent="searchByAll" class="flex flex-col items-center">
    <div class="">
        <div class="flex flex-row w-96">
            <input wire:model="search" class="search w-5/6" type="search" name="search_by" id="search_by" placeholder="rechercher par titre, ISBM ou mot cle">
            <button type="submit" class="button button_primary w-1/6">
                <img src="{{ asset('storage/images/search.png') }}" class="block h-auto w-auto fill-current text-gray-600">
            </button>
        </div>
    </div>
    <div class="flex flex-col" id="searchParametersField">
        <p class="m-3 text-2xl">Paramètres de recherche</p>
        <div class="flex flex-row space-x-3" >
            <div>
                <select wire:model="annee_debut" name="annee_parution_debut" class="select_btn mb-3">
                    <option value="">Toute annees </option>
                    @for($a=date('Y'); $a >= $annees; $a--)
                        <option value="{{ $a }}"> {{ $a }} </option>
                    @endfor
                </select>
                <select wire:model="annee_fin" name="annee_parution_fin" class="select_btn mb-3">
                    <option value="">Toute annees</option>
                    @for($a=date('Y'); $a >= $annees; $a--)
                        <option value="{{ $a }}"> {{ $a }} </option>
                    @endfor
                </select>
            </div>
            <div>
                <select wire:model="langue" name="langue" class="select_btn mb-3">
                    <option value="">Toute langues</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue }}"> {{ $langue }} </option>
                    @endforeach
                </select>
                <select wire:model="type" name="type" class="select_btn mb-3">
                    <option value="">Tous types</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}"> {{ $type }} </option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model="categorie" name="domaine" class="select_btn mb-3">
                    <option value="">Tous domaines</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie }}"> {{ $categorie }} </option>
                    @endforeach
                </select>
                <select wire:model="niveau" name="niveau" class="select_btn mb-3">
                    <option value="">Tous niveaus</option>
                    @foreach($niveaus as $niveau)
                        <option value="{{ $niveau }}"> {{ \App\Helpers\OuvrageHelper::afficherNiveau($niveau)}} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>
