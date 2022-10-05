<div class="flex flex-col justify-center items-center m-auto">
    {{-- In work, do what you enjoy. --}}
    <h1 class="text-3xl"> Livres Numerique </h1>
    <div>
        @include('livresPapier.shareSearchBarLivrePapier')
    </div>
    @if(!empty($livresNumeriques ?? "") && $livresNumeriques->count())
        @if(Auth::user() && Auth::user()->hasRole('bibliothecaire'))
            <div class="m-3">
                <div class="flex flex-row content-center space-x-3">
                    <td>
                        <form action="{{route('formulaireEnregistrementLivreNumerique')}}" method="get">
                            @csrf
                            <input type="submit" class="button button_primary" name="ajouter" value="ajouter">
                        </form>
                    </td>
                    <div class="flex flex-row">
                        <!--select wire:model="par_page" id="par_page" class="select_btn">

                        </select>
                        <label for="par_page">par page</label-->
                    </div>
                </div>
                <table class="fieldset_border bg-white">
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
                        <th class="fieldset_border">Supprimer</th>
                    </tr>
                    </thead>
                    <tbody class="all_data">
                    @foreach($livresNumeriques as $livresNumerique)
                        <tr class="dark:text-gray-500 text-center">
                            <td class="fieldset_border" >{{ $livresNumerique->id_livre_numerique }}</td>
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
                            <td class="fieldset_border">
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
            <div class="m-6 flex flex-col">
                @for($j=0; $j<count($livresNumeriques); $j += 4)
                    <div class="flex flex-row space-x-3">
                        @for($i=$j; $i<$j+4; $i++)
                            @if($livresNumeriques[$i])
                                <div class="card">
                                    <a href="{{route('affichageLivrePapier', $livresNumeriques[$i])}}" class="">
                                        <div class="image">
                                            <img src="{{ asset('storage/images/images_livre/'.$livresNumeriques[$i]->ouvragesElectronique->ouvrage->image) }}"
                                                 alt="{{$livresNumeriques[$i]->ouvragesElectronique->ouvrage->image}}" class="border border-solid"/>
                                        </div>
                                        <div class="label">
                                            <label>
                                                <span>{{ \App\Helpers\OuvrageHelper::formatString(strtolower($livresNumeriques[$i]->ouvragesElectronique->ouvrage->titre)) }}</span>
                                            </label>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endfor
                    </div>
                @endfor
            </div>
            {!! $livresNumeriques->links() !!}
        @endif
    @else
        <h3>Il n'y a aucun livre numérique.</h3>
    @endif
</div>
