@extends('layout.ouvrage.ouvrageCreate')
@section('stock')
    <fieldset>
        <legend>Fichier pdf</legend>
        <div>
            <label>url</label>
            <input type="file" name="url" accept="application/pdf" value="">
        </div>
    </fieldset>
@stop
