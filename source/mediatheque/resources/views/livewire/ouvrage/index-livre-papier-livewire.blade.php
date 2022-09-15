<div class="flex flex-col items-center">
    <h1 class="text-3xl"> Livres papier </h1>
    <div>
        @include('livresPapier.shareSearchBarLivrePapier')
    </div>
    @if(!empty($livresPapiers ?? "") && $livresPapiers->count())
        @if("" != "")
            <div class="m-3">
                <div class="flex flex-row content-center">
                    <td>
                        <form action="{{route('formulaireEnregistrementLivrePapier')}}" method="get">
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
                            <th class="border border-solid">Année apparution</th>
                            <th class="border border-solid">Niveau</th>
                            <th class="border border-solid">Type</th>
                            <th class="border border-solid">Langue</th>
                            <th class="border border-solid">Nombre d'exemplaire</th>
                            <th class="border border-solid">Disponibilité</th>
                            <th class="border border-solid">cote QR code</th>
                            <th class="border border-solid">Consulter</th>
                            <th class="border border-solid">Editer</th>
                            <th class="border border-solid">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody class="all_data">
                    @foreach($livresPapiers as $livresPapier)
                        <tr class="dark:text-gray-500 text-center">
                            <td class="border border-solid" >{{ $livresPapier->id_livre_papier }}</td>
                            <td class="border border-solid"> {{ $livresPapier->ouvragesPhysique->ouvrage->titre }} </td>
                            <td class="border border-solid"> {{ $livresPapier->ouvragesPhysique->ouvrage->annee_apparution }} </td>
                            <td class="border border-solid"> {{ \App\Helpers\OuvrageHelper::afficherNiveau($livresPapier->ouvragesPhysique->ouvrage->niveau) }} </td>
                            <td class="border border-solid"> {{ $livresPapier->ouvragesPhysique->ouvrage->type }} </td>
                            <td class="border border-solid"> {{ $livresPapier->ouvragesPhysique->ouvrage->langue }} </td>
                            <td class="border border-solid"> {{ $livresPapier->ouvragesPhysique->nombre_exemplaire }} </td>
                            <td class="border border-solid"> {!! \App\Helpers\OuvragesPhysiqueHelper::afficherDisponibilite($livresPapier->ouvragesPhysique) !!} </td>
                            <td class="border border-solid">
                                <form>
                                    @csrf
                                   <div>
                                       {{ QrCode::generate($livresPapier->ouvragesPhysique->cote) }}
                                       <a href="data:image/png;base64, {{ base64_encode(QrCode::format('png')->generate($livresPapier->ouvragesPhysique->cote)) }}"
                                          download="{{ 'cote'.str_replace(' ', '_', strtolower($livresPapier->ouvragesPhysique->ouvrage->titre)).'qrcode.png' }}"
                                       >
                                           Imprimer
                                       </a>
                                   </div>
                                </form>
                            </td>
                            <td class="border border-solid">
                                <form action="{{route('affichageLivrePapier', $livresPapier)}}" method="get">
                                    @csrf
                                    <input type="submit" name="consulter" value="Consulter" class="button button_show">
                                </form>
                            </td>
                            <td class="border border-solid">
                                <form action="{{route('formulaireModificationLivrePapier', $livresPapier)}}" method="get">
                                    @csrf
                                    <input type="submit" name="editer" value="Éditer" class="button button_edite">
                                </form>
                            </td>
                            <td class="border border-solid">
                                <form action="{{route('suppressionLivrePapier', $livresPapier)}}" method="post">
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
                {!! $livresPapiers->links() !!}
            </div>
        @elseif(""=="")
           <div class="m-6 flex space-x-3">
               @foreach($livresPapiers as $livresPapier)
                   <div>
                       <a href="{{route('affichageLivrePapier', $livresPapier)}}" class="">
                           <div class="border border-solid">
                               <img src="{{ asset('storage/images/images_livre/'.$livresPapier->ouvragesPhysique->ouvrage->image) }}"
                                    alt="{{$livresPapier->ouvragesPhysique->ouvrage->image}}" class="border border-solid"/>
                           </div>
                           <div class="text-center">
                               <label>
                                   <span>{{ strtolower($livresPapier->ouvragesPhysique->ouvrage->titre) }}</span>
                               </label>
                           </div>
                       </a>
                   </div>
               @endforeach
           </div>
            {!! $livresPapiers->links() !!}
        @endif
    @else
        <h3>Il n'y a aucun ouvrage.</h3>
    @endif
</div>
