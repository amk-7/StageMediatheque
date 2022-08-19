@extends('layout/base')
@section('content')
    <h1>Enregistrer nouveau un livre</h1>
    <form method="" action="">
        <fieldset>
            <legend>Ouvrage</legend>
            <div>
                <div>
                    <label>Titre</label>
                    <input type="text" placeholder="saisir le titre du livre">
                </div>
                <div>
                    <label>Niveau</label>
                    <select>

                    </select>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Auteur</legend>
        </fieldset>
        <fieldset>
            <legend>Particularité</legend>
        </fieldset>
        <fieldset>
            <legend>Stock</legend>
        </fieldset>
        <button type="submit">Enregister</button>
    </form>
@stop

