<div class="flex flex-col justify-center items-center m-auto">
    <h1 class="text-3xl mb-3"> Livres papier </h1>
    <div>
        @include('livresPapier.shareSearchBarLivrePapier')
    </div>

    <div class="flex flex-row content-center space-x-3">
        @if(Auth::user()->hasRole('responsable'))
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
                            <td class="fieldset_border"> {{ $livresPapier->ouvragesPhysique->ouvrage->titre }} </td>
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
           <div class="flex flex-row ml-16" style="flex-wrap: wrap;">
               @foreach($livresPapiers as $livresPapier)
                   <div class="flex flex-row space-x-3">
                       <div class="">
                           <a href="{{route('affichageLivrePapier', $livresPapier)}}" class="card">
                               <div class="image">
                                   <img src="{{ asset('storage/ouvrage_electonique/'.$livresPapier->ouvragesPhysique->ouvrage->image) }}"
                                        alt="{{$livresPapier->ouvragesPhysique->ouvrage->image}}" class="border border-solid"/>
                               </div>
                               @if(Auth::user() && Auth::user()->hasRole('abonne'))
                                   <div class="flex flex-row space-x-10">
                                       <form method="post" action="{{route('enregistrerReservation')}}">
                                           @csrf
                                           <input type="text" name="data" value="{{ $livresPapier->ouvragesPhysique->id_ouvrage }}" hidden="true">
                                           <input type="submit" class="button button_primary" name="reservation" value="reserver">
                                       </form>
                                       <label class="button button_delete">{{ $livresPapier->ouvragesPhysique->nombre_exemplaire }}</label>
                                   </div>
                               @endif
                               <div class="label">
                                   <label>
                                       <span>{{ \App\Helpers\OuvrageHelper::formatString(strtolower($livresPapier->ouvragesPhysique->ouvrage->titre)) }}</span>
                                   </label>
                               </div>
                           </a>
                       </div>
                   </div>
               @endforeach
           </div>
        @endif
            {!! $livresPapiers->links() !!}
    @else
        <h3>Il n'y a aucun ouvrage.</h3>
    @endif
</div>
