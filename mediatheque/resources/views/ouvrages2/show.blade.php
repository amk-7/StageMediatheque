@extends("layouts.app")
@section("content")
    <style>
        .show-card {
            display: flex;
        }

        .margin {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        @media screen and (max-width: 700px) {
            .show-card {
                flex-direction: column;
            }

            .margin {
                margin-top: 450px;
                margin-bottom: 100px;
            }
        }
    </style>
    <div class="flex flex-col items-center justify-center">
        <div class="bg-white flex flex-col m-auto items-center p-12 margin">
            <h1 class="text-2xl text-center">{{$ouvrage->titre }}</h1>
            <div class="show-card m-auto items-center">
                <div class="mt-4">
                    <img src="{{ $ouvrage->image }}"
                         alt="{{$ouvrage->image}}" class="border border-solid" style="width: 198px;height: 300px;"/>
                </div>
                <div class="pl-6 mt-4">
                    @php
                        $ressources = $ouvrage->ressources_externe ;
                        $ressources = explode(';', $ressources);
                    @endphp
                    <div class="flex flex-col">
                        <label>
                            <span class="label_title_sub_title">Titre :</span>
                            <span class="label_show_value">{{$ouvrage->titre }}</span>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Auteurs :</span>
                            <span class="label_show_value">{{ "" }}</span>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Lieu d'édition :</span>
                            <span class="label_show_value">{{ $ouvrage->lieu_edition }}</span>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Année d'édition :</span>
                            <span class="label_show_value">{{ $ouvrage->annee_apparution }}</span>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Niveau :</span>
                            <span class="label_show_value">{{ $ouvrage->niveau->libelle }}</span>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Type :</span>
                            <span class="label_show_value">{{$ouvrage->type->libelle }}</span>
                        </label>
                        @yield('particularite')
                        <label>
                            <span class="label_title_sub_title">Langue :</span>
                            <span class="label_show_value">{{$ouvrage->langue->libelle }}</span>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Résumer :</span>
                            <p class="label_show_value">{{ $ouvrage->resume=="pas de resumé" ? "Aucun" : $ouvrage->resume }}</p>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Ressources :</span>
                            <p class="label_show_value flex flex-col">
                                @foreach($ressources as $ressource)
                                    <li>
                                        <a href="{{ $ressource }}">{{ $ressource }}</a>
                                    </li>
                                @endforeach
                            </p>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Nombre exemplaire :</span>
                            <span class="label_show_value">{{$ouvrage->nombre_exemplaire }}</span>
                        </label>
                    </div>
                </div>
            </div>
            @if(Auth::user())
                <div class="mt-3">
                    <form action="{{ route('lirePDF', $ouvrage) }}" method="get">
                        <input type="submit" value="Lire" class="button button_primary">
                    </form>
                </div>
            @endif
        </div>
    </div>
@stop
