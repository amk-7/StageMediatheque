<div class="flex flex-col justify-center items-center m-auto my_content">
    <h1 class="text-3xl mb-3"> Livres papier </h1>
    <div>
        @include('livresPapier.shareSearchBarLivrePapier')
    </div>
    <div class="flex flex-row content-center space-x-3">
        @if(Auth::user() && (Auth::user()->hasRole('responsable') || Auth::user()->hasRole('bibliothecaire')))
            <td class="flex flex-row mb-3">
                <form action="{{route('formulaireEnregistrementLivrePapier')}}" method="get">
                    @csrf
                    <input type="submit" class="button button_primary" name="ajouter" value="ajouter">
                </form>
                <form action="{{route('formulaireEnregistrementApprovisionnements')}}" method="get">
                    @csrf
                    <input type="submit" class="button button_primary" name="approvisionement" value="approvisionner">
                </form>
                <form action="{{route('downloadExcelListeLivresPapier')}}" method="get">
                    @csrf
                    <input type="submit" class="button button_primary" name="export" value="Exporter">
                </form>
                <form action="{{route('imprimerOuvragesPhysiqueCodes')}}" method="get">
                    @csrf
                    <input type="submit" class="button button_show" name="export" value="Cotes QR codes">
                </form>
            </td>
        @endif
    </div>

    @if(!empty($livresPapiers ?? "") && $livresPapiers->count())
        @if(Auth::user() && Auth::user()->hasRole('bibliothecaire'))
            @php
                $result = \App\Service\OuvrageService::getNombreExamplaireAndOuvrage();
                $nb_ouvrage = $result[0];
                $nbr_examplaire = $result[1];
            @endphp
            <div class="flex">
                <h3>Nombre d'ouvrages : {{ $nb_ouvrage }}</h3>
                <h3 class="ml-3">Nombre d'examplaire : {{ $nbr_examplaire }}</h3>
            </div>
            <div class="m-3">
                <table class="fieldset_border bg-white">
                    <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                        <tr>
                            <th class="fieldset_border">Numéro</th>
                            <th class="fieldset_border">Titre</th>
                            <th class="fieldset_border">Année apparution</th>
                            <th class="fieldset_border">Niveau</th>
                            <th class="fieldset_border">Type</th>
                            <th class="fieldset_border">Langue</th>
                            <th class="fieldset_border">Nombre d'exemplaire</th>
                            <th class="fieldset_border">Disponibilité</th>
                            <th class="fieldset_border">cote QR code</th>
                            <th class="fieldset_border">Consulter</th>
                            <th class="fieldset_border">Editer</th>
                            @if(Auth::user()->hasRole('responsable'))
                                <th class="fieldset_border">Supprimer</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="all_data">
                    @foreach($livresPapiers as $livresPapier)
                        <tr class="dark:text-gray-500 text-center">
                            <td class="fieldset_border" >{{ $livresPapier->id_livre_papier }}</td>
                            <td class="fieldset_border uppercase"> {{ $livresPapier->ouvragesPhysique->ouvrage->titre }} </td>
                            <td class="fieldset_border"> {{ $livresPapier->ouvragesPhysique->ouvrage->annee_apparution }} </td>
                            <td class="fieldset_border"> {{ \App\Helpers\OuvrageHelper::afficherNiveau($livresPapier->ouvragesPhysique->ouvrage->niveau) }} </td>
                            <td class="fieldset_border"> {{ $livresPapier->ouvragesPhysique->ouvrage->type }} </td>
                            <td class="fieldset_border"> {{ $livresPapier->ouvragesPhysique->ouvrage->langue }} </td>
                            <td class="fieldset_border"> {{ $livresPapier->ouvragesPhysique->nombre_exemplaire }} </td>
                            <td class="fieldset_border"> {!! \App\Helpers\OuvragesPhysiqueHelper::afficherDisponibilite($livresPapier->ouvragesPhysique) !!} </td>
                            <td class="fieldset_border">
                                <form>
                                    @csrf
                                   <div class="space-y-3">
                                      <div>
                                          {{ QrCode::generate($livresPapier->ouvragesPhysique->cote) }}
                                      </div>
                                       <div>
                                           <a href="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(200)->generate($livresPapier->ouvragesPhysique->cote)) }}"
                                              download="{{ 'cote'.str_replace(' ', '_', strtolower($livresPapier->ouvragesPhysique->ouvrage->titre)).'qrcode.png' }}"
                                              class="text-center text-white bg-green-600 p-1 hover:bg-green-700 mt-2"
                                           >Imprimer
                                           </a>
                                       </div>
                                   </div>
                                </form>
                            </td>
                            <td class="fieldset_border">
                                <form action="{{route('affichageLivrePapier', $livresPapier)}}" method="get">
                                    @csrf
                                    <input type="submit" name="consulter" value="Consulter" class="button button_show">
                                </form>
                            </td>
                            <td class="fieldset_border">
                                <form action="{{route('formulaireModificationLivrePapier', $livresPapier)}}" method="get">
                                    @csrf
                                    <input type="submit" name="editer" value="Éditer" class="button button_primary">
                                </form>
                            </td>
                            @if(Auth::user()->hasRole('responsable'))
                                <td class="fieldset_border">
                                    <form id="" onclick="activeModal({{$livresPapier->id_livre_papier}})" action="{{route('suppressionLivrePapier', $livresPapier)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" id="" name="supprimer" value="Supprimer" class="button button_delete">
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                    <tbody id="result" class="result_data"></tbody>
                </table>
            </div>
        @else
            <!-- style="flex-wrap: wrap; margin-left: 95px;" -->
           <div class="flex flex-col items-center mb-12 w-full">
               @foreach($livresPapiers as $livresPapier)
                <a href="{{route('affichageLivrePapier', $livresPapier)}}"  class="mb-3 flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img
                        class="object-cover rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                        src="{{ asset(''.$livresPapier->ouvragesPhysique->ouvrage->image) }}" alt=""
                        >
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <div class="space-x-3">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $livresPapier->ouvragesPhysique->ouvrage->titre }}
                            </h5>
                            <h3 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Résumé</h3>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            </p>
                        </div>
                        {{-- @if(Auth::user() && Auth::user()->hasRole('abonne'))
                            <div class="flex flex-row space-x-10">
                                <form method="post" action="{{route('enregistrerReservation')}}">
                                    @csrf
                                    <input type="text" name="data" value="{{ $livresPapier->ouvragesPhysique->id_ouvrage }}" hidden="true">
                                    <input type="submit" class="button button_primary" name="reservation" value="reserver">
                                </form>
                                <label class="button button_delete">{{ $livresPapier->ouvragesPhysique->nombre_exemplaire }}</label>
                            </div>
                        @endif --}}
                    </div>
                </a>
               @endforeach
           </div>
        @endif
        <div style="margin-bottom: 100px">
            {!! $livresPapiers->links() !!}
        </div>
    @else
        <h3>Il n'y a aucun ouvrage.</h3>
    @endif

</div>

