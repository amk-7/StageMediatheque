<div class="flex flex-col items-center">
    {{-- In work, do what you enjoy. --}}
    <h1 class="text-3xl"> Livres Numerique </h1>
    <div>
        @include('livresPapier.shareSearchBarLivrePapier')
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
                            <form action="{{ route('suppressionLivreNumerique', $livresNumerique) }}" method="post">
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
