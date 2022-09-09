@extends('layout.base')
@section('content')
    <form action="{{ route('enregistrementImportExcel') }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <fieldset>
            <legend>Fichier excel</legend>
            <div>
                <label>Fichier</label>
                <input type="file" name="url" accept="*" value="">
            </div>
        </fieldset>
        <input type="submit" value="Importer">
    </form>
@stop
