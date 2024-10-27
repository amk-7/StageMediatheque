@extends('layouts.app')
@section('content')
    <form action="{{ route('enregistrementImportExcelNew') }}" method="post" enctype="multipart/form-data" class="m-auto flex flex-col space-y-3">
        @method('put')
        @csrf
        <h1 class="label_title">Import des livres Papier</h1>
        <fieldset class="fieldset_border space-y-3">
            <legend>Fichier excel</legend>
            <div>
                <label>Excel </label>
                <input type="file" id="execl" name="excel"/>
            </div>
            <div>
                <label>Images : </label>
                <input type="file" id="fileListe" name="fileList[]" webkitdirectory = "true" multiple/>
            </div>
            @error('fileList[]')
                <div class="alert">{{ $message }}</div>
            @enderror
        </fieldset>
        <input type="submit" class="button button_primary" value="Importer">
    </form>
@stop
