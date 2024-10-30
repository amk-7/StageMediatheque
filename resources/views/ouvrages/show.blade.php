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
    <div class="flex flex-col justify-center items-center w-full ml-28 mx-12 space-y-6">
        <div class="border flex flex-col m-auto items-center margin p-12">
            <h1 class="text-2xl text-center uppercase w-96">{{$ouvrage->titre }}</h1>
            <div class="show-card m-auto items-center">
                <div class="mt-4">
                    <img src="{{ $ouvrage->coverPath }}"
                        alt="{{$ouvrage->coverPath}}" class="border border-solid" style="width: 198px;height: 300px;"/>
                </div>
                <div class="pl-6 mt-4">
                    @php
                        $ressources = $ouvrage->ressources_externe ;
                        $ressources = explode(';', $ressources);
                    @endphp
                    <div class="flex flex-col w-96 space-y-3 overflow-y-auto">
                        <label>
                            <span class="label_title_sub_title">Titre :</span>
                            <span class="label_show_value w-12">{{$ouvrage->titre }}</span>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Auteurs :</span>
                            <span class="label_show_value">
                                {{ $ouvrage->afficherAuteurs }}
                            </span>
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
                            <span class="label_show_value">{{$ouvrage->type->libelle ?? "" }}</span>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Domaines :</span>
                            <span class="label_show_value">{{$ouvrage->afficherDomaine }}</span>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Langue :</span>
                            <span class="label_show_value">{{$ouvrage->afficherLangue }}</span>
                        </label>
                        {{-- <label>
                            <span class="label_title_sub_title">Résumer :</span>
                            <p class="label_show_value">{{ $ouvrage->resume=="" ? "Aucun" : $ouvrage->resume }}</p>
                        </label> --}}
                        {{-- <label>
                            <span class="label_title_sub_title">Ressources :</span>
                            <p class="label_show_value flex flex-col">
                                @foreach($ressources as $ressource)
                                    <li>
                                        @php
                                            if (filter_var($ressource, FILTER_VALIDATE_URL) === false) {
                                                $url = "/".$ressource;
                                            } else {
                                                $url = $ressource;
                                            }
                                        @endphp
                                        <a href="{{ $url }}" target="blank">{{ $ressource }}</a>
                                    </li>
                                @endforeach
                            </p>
                        </label> --}}
                        <label>
                            <span class="label_title_sub_title">Nombre exemplaire :</span>
                            <span class="label_show_value">{{$ouvrage->nombre_exemplaire }}</span>
                        </label>
                        <label>
                            <span class="label_title_sub_title">Mot clé :</span>
                            <span class="label_show_value">{{ $ouvrage->afficherMotCle }}</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex w-full justify-between">
                <div>
                    @if(Auth::user() && $ouvrage->documents)
                        <form action="{{ route('ouvrages.readPdf', $ouvrage) }}" method="get">
                            <input type="submit" value="Lire" class="button button_primary">
                        </form>
                    @endif
                </div>
                <div class="flex flex-col items-center">
                    <div>
                        <a href="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(200)->generate("ezrzr")) }}"
                            download="{{ 'cote'.str_replace(' ', '_', strtolower($ouvrage->titre)).'qrcode.png' }}">
                            @php
                                $text = utf8_encode($ouvrage->titre);
                                try {
                                    $qrcode = QrCode::generate($text."-");
                                } catch (\Throwable $th) {
                                    $qrcode = QrCode::generate("-");
                                }
                            @endphp
                            {{ $qrcode }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
