<form wire:submit.prevent="searchByAll" class="flex flex-col items-center">
    <div class="">
        <div class="flex flex-row w-96">
            <input wire:model="search" class="search w-5/6" type="search" name="search_by" id="search_by" placeholder="rechercher par titre, ISBM ou mot cle">
            <button type="submit" class="button button_primary w-1/6">O</button>
        </div>
    </div>
    <div class="" id="searchParametersField">
        <p>Paramètres de recherche</p>
        <div>
            <select wire:model="annee_debut" name="annee_parution_debut" class="select_btn">
                <option value="">Toute annees </option>
                @for($a=date('Y'); $a >= $annees; $a--)
                    <option value="{{ $a }}"> {{ $a }} </option>
                @endfor
            </select>
            <label>-</label>
            <select wire:model="annee_fin" name="annee_parution_fin" class="select_btn">
                <option value="">Toute annees</option>
                @for($a=date('Y'); $a >= $annees; $a--)
                    <option value="{{ $a }}"> {{ $a }} </option>
                @endfor
            </select>
            <select wire:model="langue" name="langue" class="select_btn">
                <option value="">Toute langues</option>
                @foreach($langues as $langue)
                    <option value="{{ $langue }}"> {{ $langue }} </option>
                @endforeach
            </select>
            <select wire:model="type" name="type" class="select_btn">
                <option value="">Tous types</option>
                @foreach($types as $type)
                    <option value="{{ $type }}"> {{ $type }} </option>
                @endforeach
            </select>
            <select wire:model="categorie" name="domaine" class="select_btn">
                <option value="">Tous domaines</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie }}"> {{ $categorie }} </option>
                @endforeach
            </select>
            <select wire:model="niveau" name="niveau" class="select_btn">
                <option value="">Toute niveaus</option>
                @foreach($niveaus as $niveau)
                    <option value="{{ $niveau }}"> {{ \App\Helpers\OuvrageHelper::afficherNiveau($niveau)}} </option>
                @endforeach
            </select>
        </div>
    </div>
</form>
