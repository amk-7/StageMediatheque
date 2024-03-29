@extends('layouts.app')
@section("content")
    <div class="flex flex-col justify-center items-center m-auto my_content">
        <h1 class="text-3xl mb-3">Archive Ouvrages</h1>
        <div>
            @include('components.search')
        </div>
        @if(!empty($ouvrages ?? "") && $ouvrages->count())
            @if(Auth::user() && Auth::user()->hasRole('bibliothecaire'))
                @php
                    $result = [0, 0];
                    $nb_ouvrage = $result[0];
                    $nbr_examplaire = $result[1];
                @endphp
                {{-- <div class="flex mt-3">
                    <h3>Nombre d'ouvrages : {{ $nb_ouvrage }}</h3>
                    <h3 class="ml-3">Nombre d'examplaire : {{ $nbr_examplaire }}</h3>
                </div> --}}
                <div class="m-3">
                    <table class="fieldset_border bg-white" id="ouvrages">
                        <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                            <tr>
                                <th class="fieldset_border" hidden>Numéro</th>
                                <th class="fieldset_border w-12">Titre</th>
                                <th class="fieldset_border">Année apparution</th>
                                <th class="fieldset_border">Niveau</th>
                                <th class="fieldset_border">Type</th>
                                <th class="fieldset_border">Langue</th>
                                <th class="fieldset_border" hidden>Domaine</th>
                                <th class="fieldset_border">Nombre d'exemplaire</th>
                                <th class="fieldset_border">Disponibilité</th>
                                {{-- <th class="fieldset_border">cote QR code</th> --}}
                                <th class="fieldset_border">Consulter</th>
                                <th class="fieldset_border">Editer</th>
                                @if(Auth::user()->hasRole('responsable'))
                                    <th class="fieldset_border">Supprimer</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="all_data">
                        @foreach($ouvrages as $ouvrage)
                            <tr class="dark:text-gray-500 text-center">
                                <td class="fieldset_border" hidden>{{ $ouvrage->id_ouvrage }}</td>
                                <td class="fieldset_border uppercase"> {{ $ouvrage->titre }} </td>
                                <td class="fieldset_border"> {{ $ouvrage->annee_apparution }} </td>
                                <td class="fieldset_border"> {{ $ouvrage->niveau->libelle ?? "" }} </td>
                                <td class="fieldset_border"> {{ $ouvrage->type->libelle ?? "" }} </td>
                                <td class="fieldset_border"> {{ $ouvrage->afficherLangue }} </td>
                                <td class="fieldset_border" hidden> {{ $ouvrage->afficherDomaine }} </td>
                                <td class="fieldset_border"> {{ $ouvrage->nombre_exemplaire }} </td>
                                <td class="fieldset_border">
                                    @if ($ouvrage->isAvailableInLibrary)
                                        <span class="text-green-600 capitalize">disponible</span>
                                    @else
                                        <span class="text-red-600 capitalize">pas disponible</span>
                                    @endif
                                </td>
                                {{-- <td class="fieldset_border">
                                    <div class="space-y-3">
                                        <div>
                                            {{ QrCode::generate($ouvrage->cote) }}
                                        </div>
                                        <div>
                                            <a href="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(200)->generate("ezrzr")) }}"
                                                download="{{ 'cote'.str_replace(' ', '_', strtolower($ouvrage->titre)).'qrcode.png' }}"
                                                class="text-center text-white bg-green-600 p-1 hover:bg-green-700 mt-2"
                                            >Imprimer
                                            </a>
                                        </div>
                                    </div>
                                </td> --}}
                                <td class="fieldset_border">
                                    <form action="{{route('ouvrages.show', $ouvrage)}}" method="get">
                                        @csrf
                                        <input type="submit" name="consulter" value="Consulter" class="button button_show">
                                    </form>
                                </td>
                                <td class="fieldset_border">
                                    <form action="{{route('ouvrages.edit', $ouvrage)}}" method="get">
                                        @csrf
                                        <input type="submit" name="editer" value="Éditer" class="button button_primary">
                                    </form>
                                </td>
                                @if(Auth::user()->hasRole('responsable'))
                                    <td class="fieldset_border">
                                        <form id="" onclick="activeModal({{$ouvrage->id_ouvrage}})" action="{{route('ouvrages.destroy', $ouvrage)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="button" id="" name="supprimer" value="Supprimer" class="button button_delete">
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                        <tbody id="result" class="result_data"></tbody>
                    </table>
            @endif
            {{-- <div style="mt-8">
                {!! $ouvrages->links() !!}
            </div> --}}
        @else
            <h3>Il n'y a aucun ouvrage.</h3>
        @endif

    </div>

    <div style="z-index:1000" id="overlay_suppression" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
    <div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_supprimer">
        <div class="flex flex-col items-center space-y-4">
            <div id="id_message" class="text-center">
                <p>Voulez vous vraiment supprimer cet ouvrage ?</p>
            </div>
            <div class="flex flex-row space-x-8">
                <button id="btn_annuler" class="button button_show">Annuler</button>
                <form id="form_delete_confirm" action="{{url("/ouvrages")}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" id="supprimer_ouvrage_confirm" name="supprimer" value="Supprimer" class="button button_delete">
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>

        DataTable.ext.search.push(function (settings, data, dataIndex) {
            let min = $('#min').val();
            let max = $('#max').val();
            //console.log(min);
            if (min==""){
                min = null;
            } else {
                min = new Date(min);
            }

            if (max==""){
                max = null;
            } else {
                max = new Date(max);
            }

            max = new Date(max);
            let date = new Date(data[2]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        });

        $('#langue').on('change', ()=>{
            // console.log($('#langue').val());
            langue = $('#langue').val();
            $('#ouvrages_filter').find('label').find("input[type='search']").val(langue);
            $('#ouvrages_filter').find('label').find("input[type='search']").trigger( "input" );
        });

        $('#type').on('change', ()=>{
            type = $('#type option:selected').text();
            //console.log(type);
            $('#ouvrages_filter').find('label').find("input[type='search']").val(type);
            $('#ouvrages_filter').find('label').find("input[type='search']").trigger( "input" );
        });

        $('#niveau').on('change', ()=>{
            niveau = $('#niveau option:selected').text();
            console.log(niveau);
            $('#ouvrages_filter').find('label').find("input[type='search']").val(niveau);
            $('#ouvrages_filter').find('label').find("input[type='search']").trigger( "input" );
        });

        $('#domaine').on('change', ()=>{
            // console.log($('#domaine').val());
            domaine = $('#domaine').val();
            searchOuvrages();
        });

        $('#min, #max').each(function() {
            $(this).on('change', function() {
                table.draw();
            });
        });

        let table = $('#ouvrages').DataTable();
        $('#search_by').on('input', (e)=>{
            $('#ouvrages_filter').find('label').find("input[type='search']").val($('#search_by').val());
            $('#ouvrages_filter').find('label').find("input[type='search']").trigger( "input" );
        });
        console.log();
    </script>
    <script type='text/javascript' async>

        //-------------------------------------------------
        const div_modal_supprimer = document.getElementById("modal_supprimer");
        const form_confirm = document.getElementById("form_delete_confirm");
        const btn_supprimer_ouvrage_confirm = document.getElementById("supprimer_ouvrage_confirm");
        const btn_annuler = document.getElementById("btn_annuler");
        const overlay = document.getElementById('overlay_suppression');

        function stopPropagation(){
            event.preventDefault();
            event.stopPropagation();
        }

        function activeModal(id){
            div_modal_supprimer.classList.remove("hidden");
            overlay.classList.remove('hidden');
            stopPropagation();
            form_confirm.action = `/ouvrages/${id}`;
        }

        btn_annuler.addEventListener('click', function (){
            stopPropagation();
            div_modal_supprimer.classList.add("hidden");
            overlay.classList.add('hidden');
        });
    </script>
@endsection

