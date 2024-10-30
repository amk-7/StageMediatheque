@extends('layouts.app')
@section('content')
    <div class="flex flex-col justify-center items-center w-full ml-28 mx-12 space-y-6">
        <h1 class="text-3xl"> Liste des Approvisionnements</h1>
        <div class="space-y-3 w-full">
            <form action="" method="get" class="space-y-3">
                <div class="flex flex-col items-center" method="get" action="">
                    <div class="w-96 lg:w-[800px]">
                        <div class="flex flex-row w-full border border-green-500">
                            <input class="w-10/12 lg:w-11/12 border border-none py-3" type="text" name="search" id="search" placeholder="rechercher par libelle" value="{{ $title ?? '' }}">
                            <button type="submit" class="flex flex-col items-center justify-center w-2/12 lg:w-1/12">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex space-x-3">
                        <div class="flex flex-col space-y-3">
                            <label for="start_date">Date début</label>
                            <input onchange="this.form.submit();" value="{{ $start_date ?? '' }}" type="date" name="start_date" class="border-black bg-gray-300 text-gray-900">
                        </div>
                        <div class="flex flex-col space-y-3">
                            <label for="end_date">Date fin {{  old('start_date') }} </label>
                            <input onchange="this.form.submit();" value="{{ $end_date ?? '' }}" type="date" name="end_date" class="border-black bg-gray-300 text-gray-900">
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('approvisionnements.create') }}">
                            <button type="button" class="button button_primary">Ajouter</button>
                        </a>
                    </div>
                </div>
            </form>
            <div class="w-full">
                <table class="bg-white w-full">
                    <thead class="text-xs uppercase bg-gray-200 dark:bg-gray-300 dark:text-gray-500 text-left">
                        <tr class="fieldset_border w-full">
                            <th class="fieldset_border">Ouvrage</th>
                            <th class="fieldset_border">ISBN</th>
                            <th class="fieldset_border">Nombre exempalire</th>
                            <th class="fieldset_border">Employé</th>
                            <th class="fieldset_border">Date</th>
                            <th class="fieldset_border">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="">
                    @forelse($approvisionnements as $approvisionnement)
                        <tr class="fieldset_border">
                            <td class="fieldset_border"> {{ $approvisionnement->ouvrage->titre }} </td>
                            <td class="fieldset_border">{{ $approvisionnement->ouvrage->isbn }}</td>
                            <td class="fieldset_border"> {{ $approvisionnement->nombre_exemplaire }} </td>
                            <td class="fieldset_border"> {{ $approvisionnement->personnel->utilisateur->userFullName }} </td>
                            <td class="fieldset_border"> {{ substr($approvisionnement->date_approvisionnement, 0, 10) }} </td>
                            <td class="flex space-x-3 p-2">
                                <div>
                                    <form action="{{ route('approvisionnements.update', $approvisionnement) }}" id="form_update_{{$approvisionnement->id_approvisionnement}}" method="post">
                                        @csrf
                                        @method('put')
                                        <input hidden id="form_update_nombre_exemplaire_{{$approvisionnement->id_approvisionnement}}" type="text" name="nombre_exemplaire">
                                        <button type="button" onclick="EditApprovisionnement('{{$approvisionnement->id_approvisionnement}}')" class="button button_show">
                                            Modifier
                                        </button>
                                    </form>
                                </div>
                                @if(Auth::user()->hasRole('responsable'))
                                <div>
                                    <form action="{{ route('approvisionnements.destroy', $approvisionnement) }}" id="form_destroy_{{$approvisionnement->id_approvisionnement}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="button" onclick="AlertSwal(title='Attention', text='Voulez vous vraiment supprimer cet approvisionnement ?', icon='warning', form_tag='form_destroy_{{$approvisionnement->id_approvisionnement}}');" value="Supprimer" class="button button_delete">
                                    </form>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="fieldset_border">
                                Aucun approvisionnements n'est enregistré
                            </td>
                            <td class="fieldset_border">
                            </td>
                            <td class="fieldset_border">
                            </td>
                            <td class="fieldset_border">
                            </td>
                            <td class="fieldset_border">
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
            {{ $approvisionnements->links() }}
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
@section('js_again')
    <script>
        function EditApprovisionnement(id){
            Swal.fire({
                title: "Mettre à jour l'approvisionnement",
                html: "<input class='input' id='nombre_exemplaire_sweet' type='number' name='nombre_exemplaire'>",
                showCancelButton: true,
                confirmButtonColor: "#16A34A",
                cancelButtonColor: "#DC2626",
                confirmButtonText: "Oui",
                cancelButtonText: "Annuler",
            }).then((result) => {
                if (result.isConfirmed && id != "") {
                    $(`#form_update_nombre_exemplaire_${id}`).val($('#nombre_exemplaire_sweet').val());
                    $(`#form_update_${id}`).submit();
                    $('#nombre_exemplaire_sweet').val("")
                }
            });
        }
    </script>
@endsection