@extends('layouts.app', ['page' => 'welcome',])
@section('content')
<main class="flex flex-col justify-center items-center m-auto my_content">
    <div>
        @include('components.search')
    </div>
    @if(!empty($ouvrages ?? "") && $ouvrages->count())
        <div class="flex flex-col items-center mb-12 w-full">
            @foreach($ouvrages as $ouvrage)
                <div  class="mb-3 flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full">
                    <a href="{{route('ouvrages.show', $ouvrage)}}">
                        <img
                            class=" hover:bg-gray-100 cursor-pointer object-cover rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                            src="{{ $ouvrage->image }}" alt=""
                        >
                    </a>
                    <div class="flex flex-col justify-between p-4 leading-normal w-full">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 text-center">
                            {{ $ouvrage->titre }}
                        </h5>
                        {{-- <label>
                            <span class="label_title_sub_title">Ressources externe :</span>
                            <p class="label_show_value flex flex-col">
                                @php
                                    $ressources = $ouvrage->ressources_externe ;
                                    $ressources = explode(';', $ressources);
                                @endphp
                                @foreach($ressources as $ressource)
                                    <li>
                                        <a href="{{ $ressource }}">{{ $ressource }}</a>
                                    </li>
                                @endforeach
                            </p>
                        </label> --}}
                        @if(Auth::user() && Auth::user()->hasRole('abonne'))
                            <div class="flex flex-row space-x-10">
                                <form method="post" action="{{route('enregistrerReservation')}}">
                                    @csrf
                                    <input type="text" name="data" value="{{ $ouvrage->id_ouvrage }}" hidden="true">
                                    <input type="submit" class="button button_primary" name="reservation" value="reserver">
                                </form>
                                <label class="button button_delete">{{ $ouvrage->nombre_exemplaire }}</label>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            {{-- @foreach($livresNumeriques as $livresPapier)
                <a href="{{route('affichageLivrePapier', $livresPapier)}}"  class="mb-3 flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full hover:bg-gray-100">
                    <img
                        class="object-cover rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                        src="{{ asset(''.$livresPapier->ouvragesPhysique->ouvrage->image) }}" alt=""
                        >
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <div class="space-y-3">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $livresPapier->ouvragesPhysique->ouvrage->titre }}
                            </h5>
                        </div>
                    </div>
                </a>
            @endforeach --}}
        </div>
        <div style="margin-bottom: 100px">
            {!! $ouvrages->links() !!}
        </div>
    @else
        <h3>Il n'y a aucun ouvrage.</h3>
    @endif
</main>
<div style="z-index:1000" id="overlay" class="fixed z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60 hidden"></div>
<div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_editer">
    <div class="flex flex-col items-center space-y-4">
        <div id="id_message" class="">
            <p id="etat_ouvrage_modif_erreur"></p>
        </div>
        <button id="btn_modifier" class="button button_primary">J'ai compris</button>
    </div>
</div>
<!-- Overlay element -->
<div style="z-index:1000" id="overlay_suppression" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
<div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_supprimer">
    <div class="flex flex-col items-center space-y-4">
        <div id="id_message" class="text-center">
            <p>Voulez vous vraiment supprimer cet ouvrage ?</p>
        </div>
        <div class="flex flex-row space-x-8">
            <button id="btn_annuler" class="button button_show">Annuler</button>
            <form id="form_delete_confirm" action="{{url("suppression_livre_papier")}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" id="supprimer_ouvrage_confirm" name="supprimer" value="Supprimer" class="button button_delete">
            </form>
        </div>
    </div>
</div>
@endsection
