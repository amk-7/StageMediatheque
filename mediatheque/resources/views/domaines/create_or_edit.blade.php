@extends('layouts.app')
@section('content')
@php
    $is_edit = ($domaine ?? null && ($domaine->id_domaine ?? null)) ? true : false;
    $title = $is_edit ? "Mise à jour le domaine ".$domaine->libelle : "Ajouter un nouveau domaine" ;
    $action = $is_edit ? route("domaines.update", $domaine) : route("domaines.store") ;
@endphp
<div class="flex flex-col justify-center items-center border w-full ml-28 mx-12 space-y-6">
    <form action="{{ $action }}" method="post" class="w-full">
        @csrf
        @if($is_edit)
            @method('PUT')
        @endif
        <div class="p-12 space-y-5">
            <h1 class="label_title"> {{ $title }} </h1>
            <div class="w-full space-y-3">
                <div class="w-full">
                    <label class="label">Nom</label>
                    <input type="text" name="libelle" value="{{ @old('libelle', $is_edit ? $domaine->libelle : '') }}" class="input @error('libelle') border border-red-600 @else border-gray-300 @enderror">
                </div>
                @error('libelle')
                <div>
                    <span class="error"> {{ $message }} </span>
                </div>
                @enderror
            </div>
            <input type="submit" value="Enregistré" class="button button_primary">
        </div>
    </form>
</div>
@endsection

