@extends("layout.template.base", ['body_style'=> "bg-gray-200 flex content-center justify-center h-full items-center", 'hfull'=>'h-full'])
@section("content")
    <main class=" bg-white flex flex-col items-center p-12">
        <h1 class="text-2xl">{{$ouvrage->titre }}</h1>
        <div class="flex flex-row m-auto p-3.5">
            <div class="">
                <img src="{{ asset('storage/ouvrage_electonique/'.$ouvrage->image) }}"
                     alt="{{$ouvrage->image}}" class="border border-solid" style="width: 198px;height: 300px;"/>
            </div>
            <div class="pl-6">
                <div class="flex flex-col">
                    <label>
                        <span class="label_title_sub_title">Titre :</span>
                        <span class="label_show_value">{{$ouvrage->titre }}</span>
                    </label>
                    <label>
                        <span class="label_title_sub_title">Auteurs :</span>
                        <span class="label_show_value">{{ \App\Helpers\OuvrageHelper::afficherAuteurs( $ouvrage) }}</span>
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
                        <span class="label_show_value">{{ $ouvrage->niveau }}</span>
                    </label>
                    <label>
                        <span class="label_title_sub_title">Type :</span>
                        <span class="label_show_value">{{$ouvrage->type }}</span>
                    </label>
                    @yield('particularite')
                    <label>
                        <span class="label_title_sub_title">Langue :</span>
                        <span class="label_show_value">{{$ouvrage->langue }}</span>
                    </label>
                    @yield('stock')
                </div>
            </div>
        </div>
        <!--div class="flex flex-row space-x-32">
            <form action="" method="get">
                <input class="button button_edite" type="submit" name="retour" value="Retour">
            </form>
            <form action="" method="get">
                <input class="button button_edite" type="submit" name="suivant" value="suivant">
            </form>
        </div-->
    </main>
@stop
