@extends('layouts.app')
@section('content')
    <div class="flex flex-col justify-center items-center w-full ml-28 mx-12 space-y-6">
        <h1 class="text-3xl"> Liste des Ouvrages </h1>
        <div class="space-y-3 w-full">
            @include('components.search')
            <div class="flex justify-between">
                <div class="flex mt-3">
                    <h3>Nombre d'ouvrages : {{ $nb_ouvrage ?? 0 }}</h3>
                </div>
                @if(Auth::user() && (Auth::user()->hasRole('responsable') || Auth::user()->hasRole('bibliothecaire')))
                <div class="flex space-x-3">
                    <a href="{{route('ouvrages.create')}}">
                        <input type="button" class="button button_primary" name="ajouter" value="ajouter">
                    </a>
                    <form action="{{route('formulaireEnregistrementApprovisionnements')}}" method="get">
                        @csrf
                        <input type="submit" class="button button_primary" name="approvisionement" value="approvisionner">
                    </form>
                    <form action="{{ route('exporter_ouvrages') }}" method="get">
                        @csrf
                        <input type="submit" class="button button_primary" name="export" value="Exporter">
                    </form>
                </div>
                @endif
            </div>
            <div class="">
                <table class="bg-white w-full">
                    <thead class="text-xs uppercase bg-gray-200 dark:bg-gray-300 dark:text-gray-500 text-left">
                        <tr class="fieldset_border w-full">
                        <th class="fieldset_border" hidden>Numéro</th>
                        <th class="fieldset_border">Titre</th>
                        <th class="fieldset_border">Année apparution</th>
                        <th class="fieldset_border">Niveau</th>
                        <th class="fieldset_border">Type</th>
                        <th class="fieldset_border">Langue</th>
                        <th class="fieldset_border" hidden>Domaine</th>
                        <th class="fieldset_border">Nombre d'exemplaire</th>
                        <th class="fieldset_border">Disponibilité</th>
                        <th class="fieldset_border">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="">
                    @forelse($ouvrages as $ouvrage)
                        <tr class="fieldset_border">
                            <td class="fieldset_border" hidden>{{ $ouvrage->id_ouvrage }}</td>
                            <td class="fieldset_border uppercase"> {{ $ouvrage->titre }} </td>
                            <td class="fieldset_border w-[2px]"> {{ $ouvrage->annee_apparution }} </td>
                            <td class="fieldset_border"> {{ $ouvrage->niveau->libelle ?? "" }} </td>
                            <td class="fieldset_border"> {{ $ouvrage->type ?? "" }} </td>
                            <td class="fieldset_border"> {{ $ouvrage->afficherLangues }} </td>
                            <td class="fieldset_border w-[2px]"> {{ $ouvrage->nombre_exemplaire }} </td>
                            <td class="fieldset_border">
                                @if ($ouvrage->isAvailableInLibrary)
                                <span class="text-green-600 capitalize">Disponible</span>
                                @else
                                <span class="text-red-600 capitalize">Non disponible</span>
                                @endif
                            </td>
                            <td class="flex space-x-3 p-2">
                                <div>
                                    <a href="{{ route('ouvrages.show', $ouvrage) }}">
                                        <button type="button" class="button button_show">
                                            Consulter
                                        </button>
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('ouvrages.edit', $ouvrage) }}">
                                        <button type="button" class="button button_primary">
                                            Modifier
                                        </button>
                                    </a>
                                </div>
                                @if(Auth::user()->hasRole('responsable'))
                                <div>
                                    <form action="{{ route('ouvrages.destroy', $ouvrage) }}" id="form_destroy{{$ouvrage->id_ouvrage}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="button" onclick="AlertSwal(title='Attention', text='Voulez vous vraiment supprimer cet ouvrage ?', icon='warning', form_tag='form_destroy{{$ouvrage->id_ouvrage}}');" value="Supprimer" class="button button_delete">
                                    </form>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="fieldset_border">
                                Aucun ouvrage n'est enregistré
                            </td>
                            <td class="fieldset_border">
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-full">
            {{ $ouvrages->links() }}
        </div>
    </div>
@endsection
@if (session('success'))
@section('js')
    <script>
        AlertSwalInfo(title='Info', text="{!! session('success') !!}", icon='success');
    </script>
@endsection
@endif
@if (session('error'))
@section('js')
    <script>
        AlertSwalInfo(title='Info', text="{!! session('error') !!}", icon='error');
    </script>
@endsection
@endif
@section('js')
<script>
    $('#langue').on('change', () => {
        submit_form();
    });

    $('#type').on('change', () => {
        submit_form();
    });

    $('#niveau').on('change', () => {
        submit_form();
    });

    $('#domaine').on('change', () => {
        submit_form();
    });

    $('#min, #max').on('change', () => {
        submit_form();
    });

    function submit_form() {
        $('#form').submit();
    }
</script>
@endsection
