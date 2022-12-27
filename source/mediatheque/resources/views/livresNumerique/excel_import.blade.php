@extends('layout.template.base')
@section('content')
    <form action="{{ route('enregistrementImportExcelLivresNumerique') }}" method="post" enctype="multipart/form-data" class="m-auto flex flex-col space-y-3">
        @method('put')
        @csrf
        <fieldset class="fieldset_border space-y-3">
            <legend>Fichier excel</legend>
            <div>
                <label>Excel </label>
                <input type="file" id="execl" name="excel" required/>
            </div>
            <div>
                <label>Fichiers </label>
                <input type="file" id="filepicker" name="fileList[]" webkitdirectory = "true" multiple required/>
                <ul id="listing"></ul>
            </div>
            @error('fileList[]')
                <div class="alert">{{ $message }}</div>
            @enderror
        </fieldset>
        <input type="submit" class="button button_primary" value="Importer">
    </form>
@stop
