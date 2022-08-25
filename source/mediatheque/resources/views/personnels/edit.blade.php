<?php
?>

<title>Modifier un Personnel</title>
    <h1> Modifier un Personnel </h1>
    <form action="{{ route('updatePersonnel', $personnel->id_personnel) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="statut">Statut
            <input type="text" name="statut" value="{{$personnel->statut}}">
        </label></br>
        <button type="Submit">Modifier</button>
    </form>

