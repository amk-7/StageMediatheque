<div class="flex flex-col justify-center items-center m-auto">
    {{-- In work, do what you enjoy. --}}
    <h1 class="text-3xl"> Livres Numerique </h1>
    <div>
        @include('livresPapier.shareSearchBarLivrePapier')
    </div>
    <div class="flex flex-row content-center space-x-3">
        @if(Auth::user() && (Auth::user()->hasRole('responsable') || Auth::user()->hasRole('bibliothecaire')))
            <td class="flex flex-row mb-3">
                <form action="{{route('formulaireEnregistrementLivreNumerique')}}" method="get">
                    @csrf
                    <input type="submit" class="button button_primary" name="ajouter" value="ajouter">
                </form>
            </td>
        @endif
    </div>
    @if(!empty($livresNumeriques ?? "") && $livresNumeriques->count())
        @if(Auth::user() && Auth::user()->hasRole('bibliothecaire'))
            <div class="m-3">
                <table class=" bg-white">
                    <thead class="text-xs bg-white uppercase bg-gray-70 dark:bg-gray-300 dark:text-gray-500 text-center">
                    <tr>
                        <th class="fieldset_border">Numéro</th>
                        <th class="fieldset_border">Titre</th>
                        <th class="fieldset_border">Niveau</th>
                        <th class="fieldset_border">Type</th>
                        <th class="fieldset_border">Langue</th>
                        <th class="fieldset_border">ISBN</th>
                        <th class="fieldset_border">Consulter</th>
                        <th class="fieldset_border">Editer</th>
                        @if(Auth::user()->hasRole('responsable'))
                            <th class="fieldset_border">Supprimer</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="all_data">
                    @foreach($livresNumeriques as $livresNumerique)
                        <tr class="dark:text-gray-500 text-center">
                            <td class="fieldset_border" >{{ $loop->index+1 }}</td>
                            <td class="fieldset_border"> {{ $livresNumerique->ouvragesElectronique->ouvrage->titre}} </td>
                            <td class="fieldset_border"> {{ \App\Helpers\OuvrageHelper::afficherNiveau($livresNumerique->ouvragesElectronique->ouvrage->niveau) }} </td>
                            <td class="fieldset_border"> {{ $livresNumerique->ouvragesElectronique->ouvrage->type }} </td>
                            <td class="fieldset_border"> {{ $livresNumerique->ouvragesElectronique->ouvrage->langue }} </td>
                            <td class="fieldset_border"> {{ $livresNumerique->ISBN }} </td>
                            <td class="fieldset_border">
                                <form action="{{ route('affichageLivreNumerique', $livresNumerique) }}" method="get">
                                    @csrf
                                    <input type="submit" name="consulter" value="Consulter" class="button button_show">
                                </form>
                            </td>
                            <td class="fieldset_border">
                                <form action="{{ route('formulaireModificationLivreNumerique', $livresNumerique) }}" method="get">
                                    @csrf
                                    <input type="submit" name="editer" value="Éditer" class="button button_primary">
                                </form>
                            </td>
                            @if(Auth::user()->hasRole('responsable'))
                                <td class="fieldset_border">
                                    <form action="" method="">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" onclick="activeModal({{$livresNumerique->id_livre_numerique}})" name="supprimer" value="Supprimer" class="button button_delete">
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                    <tbody id="result" class="result_data"></tbody>
                </table>
                {!! $livresNumeriques->links() !!}
            </div>
        @else
            <div id="id_table_liste" class="flex flex-col items-center mb-12 w-full">
                @foreach($livresNumeriques as $livresNumerique)
                    <a href="{{route('affichageLivreNumerique', $livresNumerique)}}"  class="mb-3 flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img 
                            class="object-cover rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" 
                            src="{{ asset(''.$livresNumerique->ouvragesElectronique->ouvrage->image) }}" alt=""
                            >
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <div class="space-x-3">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $livresNumerique->ouvragesElectronique->ouvrage->titre }}
                                </h5>
                                <!-- <h3 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Résumé</h3>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                </p> -->
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            {!! $livresNumeriques->links() !!}
        @endif
    @else
        <h3>Il n'y a aucun livre numérique.</h3>
    @endif
</div>
