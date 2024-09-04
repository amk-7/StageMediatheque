@extends('layouts.app')
@section('content')
    <div class="flex flex-col justify-center items-center w-full ml-28 mx-12 space-y-6">
        <h1 class="text-3xl"> Liste des Types</h1>
        <div class="space-y-3 w-full">
            <form class="flex flex-col items-center" method="get" action="">
                <div class="w-96 lg:w-[800px]">
                    <div class="flex flex-row w-full border border-green-500">
                        <input class="w-10/12 lg:w-11/12 border border-none py-3" type="text" name="search" id="search" placeholder="rechercher par libelle" value="{{ old('selected_search_by') }}">
                        <button type="submit" class="flex flex-col items-center justify-center w-2/12 lg:w-1/12">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            <div class="flex flex-row-reverse">
                <a href="{{ route('types_ouvrages.create') }}">
                    <button type="button" class="button button_primary">Ajouter</button>
                </a>
            </div>
            <div class="w-full">
                <table class="bg-white w-full">
                    <thead class="text-xs uppercase bg-gray-200 dark:bg-gray-300 dark:text-gray-500 text-left">
                        <tr class="fieldset_border w-full">
                            <th class="fieldset_border w-2/3">Libelle</th>
                            <th class="fieldset_border w-1/3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="">
                    @forelse($types_ouvrages as $types_ouvrage)
                        <tr class="fieldset_border">
                            <td class="fieldset_border"> {{ $types_ouvrage->libelle }} </td>
                            <td class="flex space-x-3 p-2">
                                <div>
                                    <a href="{{ route('types_ouvrages.edit', $types_ouvrage) }}">
                                        <button type="button" class="button button_show">
                                            Modifier
                                        </button>
                                    </a>
                                </div>
                                <div>
                                    <form action="{{ route('types_ouvrages.destroy', $types_ouvrage) }}" id="form_destroy{{$types_ouvrage->id_type_ouvrage}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="button" onclick="AlertSwal(title='Attention', text='Voulez vous vraiment supprimer cet type ?', icon='warning', form_tag='form_destroy{{$types_ouvrage->id_type_ouvrage}}');" value="Supprimer" class="button button_delete">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="fieldset_border">
                                Aucun Type n'est enregistré
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
            {{ $types_ouvrages->links() }}
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