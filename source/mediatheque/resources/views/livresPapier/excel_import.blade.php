@extends('layout.template.base')
@section('content')
    <form action="{{ route('enregistrementImportExcel') }}" method="post" enctype="multipart/form-data" class="m-auto flex flex-col space-y-3">
        @method('put')
        @csrf
        <fieldset class="fieldset_border">
            <legend>Fichier excel</legend>
            <div>
                <label>Fichier</label>
                <input type="file" name="url" accept="*" value="" class="input @error('url') is-invalid @enderror">
                @error('url')
                <div class="alert">{{ $message }}</div>
                @enderror
            </div>
        </fieldset>
        <input type="submit" class="button button_primary" value="Importer">
    </form>
@stop
