<!--style>
    .search-bar {
        display: flex;
        flex-direction: row;
    }
    @media (max-width: 600px) {
        .search-bar {
            flex-direction: column;
        }
    }
</style-->
{{-- <form wire:submit.prevent="searchByAll" class="flex flex-col items-center">
    <div class="">
        <div class="flex flex-row w-96">
            <input wire:model="search" class="search w-5/6" type="search" name="search_by" id="search_by" placeholder="rechercher par titre, ISBM ou mot cle">
            <button type="submit" class="button button_primary w-1/6">
                <img src="{{ asset('storage/images/search.png') }}" class="block h-auto w-auto fill-current text-gray-600">
            </button>
        </div>
    </div>
    <div class="flex flex-col items-center m-auto" id="searchParametersField">
        <div>
            <p class="m-3 text-2xl">Paramètres de recherche</p>
        </div>
        <div class="m-3 md:flex md:space-x-3">
            <div class="flex space-x-3">
                <select wire:model="annee_debut" wire:change.prevent="searchByAll" name="annee_parution_debut" class="select_btn w-1/2 mb-3">
                    <option value=""> Début </option>
                    @for($a=date('Y'); $a >= $annees; $a--)
                        <option value="{{ $a }}"> {{ $a }} </option>
                    @endfor
                </select>
                <select wire:model="annee_fin" wire:change.prevent="searchByAll" name="annee_parution_fin" class="select_btn w-1/2 mb-3" style="">
                    <option value=""> Fin </option>
                    @for($a=date('Y'); $a >= $annees; $a--)
                        <option value="{{ $a }}"> {{ $a }} </option>
                    @endfor
                </select  >
            </div>
            <div class="flex space-x-3">
                <select wire:model="langue" wire:change.prevent="searchByAll" name="langue" class="select_btn w-full mb-3">
                    <option value="">Toute langues</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue }}"> {{ $langue }} </option>
                    @endforeach
                </select>
                <select wire:model="type" wire:change.prevent="searchByAll" name="type" class="select_btn w-full mb-3">
                    <option value="">Tous types</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}"> {{ $type }} </option>
                    @endforeach
                </select>
            </div>
            <div class="flex space-x-3">
                <select wire:model="categorie" wire:change.prevent="searchByAll" name="domaine" class="select_btn w-full mb-3">
                    <option value="">Tous domaines</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie }}"> {{ $categorie }} </option>
                    @endforeach
                </select>
                <select wire:model="niveau" wire:change.prevent="searchByAll" name="niveau" class="select_btn w-full mb-3">
                    <option value="">Tous niveaus</option>
                    @foreach($niveaus as $niveau)
                        <option value="{{ $niveau }}"> {{ \App\Helpers\OuvrageHelper::afficherNiveau($niveau)}} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form> --}}
@php
    $old_annee_debut = $_REQUEST['annee_debut'] ?? "";
    $old_annee_fin = $_REQUEST['annee_fin'] ?? "";
    $old_langue = $_REQUEST['langue'] ?? "";
    $old_type = $_REQUEST['type'] ?? "";
    $old_domaine = $_REQUEST['domaine'] ?? "";
    $old_niveau = $_REQUEST['niveau'] ?? "";
@endphp
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
                <select id="annee_debut" name="annee_debut" class="select_btn w-1/2 mb-3">
                    <option value=""> Début </option>
                    @for($a=date('Y'); $a >= $annees; $a--)
                        <option value="{{ $a }}" {{ $old_annee_debut == $a ? 'selected' : '' }}> {{ $a }} </option>
                    @endfor
                </select>
                <select name="annee_fin" class="select_btn w-1/2 mb-3" style="">
                    <option value=""> Fin </option>
                    @for($a=date('Y'); $a >= $annees; $a--)
                        <option value="{{ $a }}"  {{ $old_annee_fin == $a ? 'selected' : '' }}> {{ $a }} </option>
                    @endfor
                </select  >
            </div>
            <div class="flex space-x-3">
                <select name="langue" class="select_btn w-full mb-3">
                    <option value="">Toute langues</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue }}"  {{ $old_langue == $langue ? 'selected' : '' }}> {{ $langue }} </option>
                    @endforeach
                </select>
                <select name="type" class="select_btn w-full mb-3">
                    <option value="">Tous types</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ $old_type == $type ? 'selected' : '' }}> {{ $type }} </option>
                    @endforeach
                </select>
            </div>
            <div class="flex space-x-3">
                <select name="domaine" class="select_btn w-full mb-3">
                    <option value="">Tous domaines</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie }}" {{ $old_domaine == $categorie ? 'selected' : '' }}> {{ $categorie }} </option>
                    @endforeach
                </select>
                <select name="niveau" class="select_btn w-full mb-3">
                    <option value="">Tous niveaus</option>
                    @foreach($niveaus as $niveau)
                        <option value="{{ $niveau }}" {{ $old_niveau == $niveau ? 'selected' : '' }} > {{ \App\Helpers\OuvrageHelper::afficherNiveau($niveau)}} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>
<script type="text/javaScript">
    // Sélectionnez tous les éléments avec la classe select_btn
    let select_btns = document.getElementsByClassName('select_btn');

    // Ajoutez un écouteur d'événements 'change' à chaque élément
    for (let i = 0; i < select_btns.length; i++) {
        select_btns[i].addEventListener('change', function() {
            // Soumettez le formulaire parent lorsque la valeur change
            this.form.submit();
        });
    }
</script>
