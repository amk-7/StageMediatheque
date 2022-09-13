<div class="flex flex-col items-center">
    {{-- In work, do what you enjoy. --}}
    <h1 class="text-3xl"> Livres Numerique </h1>
    <div>
        <form wire:submit.prevent="searchByAll" class="flex flex-col items-center">
            <div class="">
                <div class="flex flex-row">
                    <input wire:model="search" class="search" type="search" name="search_by" id="search_by" placeholder="rechercher par titre, ISBM ou mot cle">
                    <button type="submit" class="button button_edite">Rechercher</button>
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
    </div>
    @if(!empty($livresNumeriques ?? "") && $livresNumeriques->count())
        <div class="m-3">
            <div class="flex flex-row content-center">
                <td>
                    <form action="{{route('formulaireEnregistrementLivreNumerique')}}" method="get">
                        @csrf
                        <input type="submit" class="button button_edite" name="ajouter" value="ajouter">
                    </form>
                </td>
                <div class="flex flex-row">
                    <select wire:model="par_page" id="par_page" class="select_btn">
                        @for($i = 5; $i <= 25; $i = $i+5)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <label for="par_page">par page</label>
                </div>
            </div>
            <table class="w-full text-sm text-left text-white">
                <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                <tr>
                    <th class="border border-solid">Numéro</th>
                    <th class="border border-solid">Titre</th>
                    <th class="border border-solid">Niveau</th>
                    <th class="border border-solid">Type</th>
                    <th class="border border-solid">Langue</th>
                    <th class="border border-solid">ISBN</th>
                    <th class="border border-solid">Consulter</th>
                    <th class="border border-solid">Editer</th>
                    <th class="border border-solid">Supprimer</th>
                </tr>
                </thead>
                <tbody class="all_data">
                @foreach($livresNumeriques as $livresNumerique)
                    <tr class="dark:text-gray-500 text-center">
                        <td class="border border-solid" >{{ $livresNumerique->id_livre_numerique }}</td>
                        <td class="border border-solid"> {{ $livresNumerique->ouvragesElectronique->ouvrage->titre}} </td>
                        <td class="border border-solid"> {{ \App\Helpers\OuvrageHelper::afficherNiveau($livresNumerique->ouvragesElectronique->ouvrage->niveau) }} </td>
                        <td class="border border-solid"> {{ $livresNumerique->ouvragesElectronique->ouvrage->type }} </td>
                        <td class="border border-solid"> {{ $livresNumerique->ouvragesElectronique->ouvrage->langue }} </td>
                        <td class="border border-solid"> {{ $livresNumerique->ISBN }} </td>
                        <td class="border border-solid">
                            <form action="{{ route('affichageLivreNumerique', $livresNumerique) }}" method="get">
                                @csrf
                                <input type="submit" name="consulter" value="Consulter" class="button button_show">
                            </form>
                        </td>
                        <td class="border border-solid">
                            <form action="{{ route('formulaireModificationLivreNumerique', $livresNumerique) }}" method="get">
                                @csrf
                                <input type="submit" name="editer" value="Éditer" class="button button_edite">
                            </form>
                        </td>
                        <td class="border border-solid">
                            <form action="{{ route('suppressionLivreElectronique', $livresNumerique) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" name="supprimer" value="Supprimer" class="button button_delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tbody id="result" class="result_data"></tbody>
            </table>
            {!! $livresNumeriques->links() !!}
        </div>
    @else
        <h3>Il n'y a aucun livre numérique.</h3>
    @endif
</div>
