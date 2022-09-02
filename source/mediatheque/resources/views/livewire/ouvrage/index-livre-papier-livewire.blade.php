<div>
    {{ $search }}
    <h1> Livres papier </h1>
    <div>
        <form wire:submit.prevent="searchByAll">
            <ul id="searchModTabs">
                <li class="active">
                    <a class="change_search_mode" href="">Recherche</a>
                </li>
            </ul>
            <div class="">
                <div class="input">
                    <input wire:model="search" type="search" name="search_by" id="search_by" placeholder="rechercher par titre, ISBM ou mot cle">
                    <button type="submit">Rechercher</button>
                </div>
            </div>
            <div class="" id="searchParametersField">
                <p>Paramètre de recherche</p>
                <div>
                    <select wire:model="annee_debut" name="annee_parution_debut">
                        <option value="">Toute annees </option>
                        @for($a=date('Y'); $a >= $annees; $a--)
                            <option value="{{ $a }}"> {{ $a }} </option>
                        @endfor
                    </select>
                    <label>-</label>
                    <select wire:model="annee_fin" name="annee_parution_fin">
                        <option value="">Toute annees</option>
                        @for($a=date('Y'); $a >= $annees; $a--)
                            <option value="{{ $a }}"> {{ $a }} </option>
                        @endfor
                    </select>
                    <select wire:model="langue" name="langue">
                        <option value="">Toute langues</option>
                        @foreach($langues as $langue)
                            <option value="{{ $langue }}"> {{ $langue }} </option>
                        @endforeach
                    </select>
                    <select wire:model="type" name="type">
                        <option value="">Tous types</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}"> {{ $type }} </option>
                        @endforeach
                    </select>
                    <select wire:model="categorie" name="domaine">
                        <option value="">Tous domaines</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie }}"> {{ $categorie }} </option>
                        @endforeach
                    </select>
                    <select wire:model="niveau" name="niveau">
                        <option value="">Toute niveaus</option>
                        @foreach($niveaus as $niveau)
                            <option value="{{ $niveau }}"> {{ \App\Helpers\OuvrageHelper::afficherNiveau($niveau)}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div>
        <td>
            <form action="{{route('formulaireEnregistrementLivrePapier')}}" method="get">
                @csrf
                <input type="submit" name="ajouter" value="ajouter">
            </form>
        </td>
        <td>
            <form action="{{route('formulaireEnregistrementApprovisionnement')}}" method="get">
                @csrf
                <input type="submit" name="approvisionnement" value="Approvisionner">
            </form>
        </td>
    </div>
    <div>
        <select  id="par_page">
            @for($i = 5; $i <= 25; $i = $i+5)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <label for="par_page">par page</label>
    </div>
    @if(!empty($livresPapiers ?? "") && $livresPapiers->count())
        <div class="overflow-x-auto relative shadow-md m-2">
            <table class="w-full text-sm text-left text-white">
                <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                <th class="border border-solid">Numéro</th>
                <th class="border border-solid">Titre</th>
                <th class="border border-solid">Niveau</th>
                <th class="border border-solid">Type</th>
                <th class="border border-solid">Domaine</th>
                <th class="border border-solid">Langue</th>
                <th class="border border-solid">Nombre d'exemplaire</th>
                <th class="border border-solid">Disponibilité</th>
                <th class="border border-solid">ISBN</th>
                <th class="border border-solid">Consulter</th>
                <th class="border border-solid">Editer</th>
                <th class="border border-solid">Supprimer</th>
                </thead>
                <tbody class="all_data">
                @foreach($livresPapiers as $livresPapier)
                    <tr class="border-b dark:bg-gray-500 dark:border-gray-700 text-center">
                        <td class="border border-solid" >{{ $livresPapier->id_livre_papier }}</td>
                        <td class="border border-solid"> {{ $livresPapier->ouvragePhysique->ouvrage->titre }} </td>
                        <td class="border border-solid"> {{ \App\Helpers\OuvrageHelper::afficherNiveau($livresPapier->ouvragePhysique->ouvrage->niveau) }} </td>
                        <td class="border border-solid"> {{ $livresPapier->ouvragePhysique->ouvrage->type }} </td>
                        <td class="border border-solid"> {{ \App\Helpers\LivrePapierHelper::showArray($livresPapier->categorie) }} </td>
                        <td class="border border-solid"> {{ $livresPapier->ouvragePhysique->ouvrage->langue }} </td>
                        <td class="border border-solid"> {{ $livresPapier->ouvragePhysique->nombre_exemplaire }} </td>
                        <td class="border border-solid"> {!! \App\Helpers\OuvragesPhysiqueHelper::afficherDisponibilite($livresPapier->ouvragePhysique) !!} </td>
                        <td class="border border-solid"> {{ $livresPapier->ISBN }} </td>
                        <td class="border border-solid">
                            <form action="{{route('affichageLivrePapier', $livresPapier)}}" method="get">
                                @csrf
                                <input type="submit" name="consulter" value="Consulter" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            </form>
                        </td>
                        <td class="border border-solid">
                            <form action="{{route('formulaireModificationLivrePapier', $livresPapier)}}" method="get">
                                @csrf
                                <input type="submit" name="editer" value="Éditer" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            </form>
                        </td>
                        <td class="border border-solid">
                            <form action="{{route('suppressionLivrePapier', $livresPapier)}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" name="supprimer" value="Supprimer"class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tbody id="result" class="result_data"></tbody>
            </table>
        </div>
    @else
        <h3>Il n'y a aucun ouvrage.</h3>
    @endif
    {!! $livresPapiers->links() !!}
</div>
