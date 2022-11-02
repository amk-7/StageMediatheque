@extends('layout.template.base')
@section('content')
    <form action="{{ route('enregistrementImportExcelLivresNumerique') }}" method="post" enctype="multipart/form-data" class="m-auto flex flex-col space-y-3">
        @method('put')
        @csrf
        <fieldset class="fieldset_border">
            <legend>Fichier excel</legend>
            <div>
                <label>Dossier image</label>
                <input type="file" name="directory" accept="*" value="">
            </div>
            <div>
                <label>Fichier</label>
                <input type="file" name="url" accept="*" value="">
            </div>
            @error('url')
                <div class="alert">{{ $message }}</div>
            @enderror
        </fieldset>
        <input type="submit" class="button button_primary" value="Importer">
    </form>
@stop
