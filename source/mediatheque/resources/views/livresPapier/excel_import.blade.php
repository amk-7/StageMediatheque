@extends('layout.template.base')
@section('content')
    <form action="{{ route('enregistrementImportExcel') }}" method="post" enctype="multipart/form-data" class="m-auto">
        @method('put')
        @csrf
        <fieldset class="border border-solid">
            <legend>Fichier excel</legend>
            <div>
                <label>Fichier</label>
                <input type="file" name="url" accept="*" value="">
            </div>
        </fieldset>
        <input type="submit" value="Importer">
    </form>
@stop
