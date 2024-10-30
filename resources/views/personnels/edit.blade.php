

@extends('layouts.user.userEdit', ['action'=>"personnels.update", 'title'=>"Modifier un personnel", 'utilisateur'=>$personnel->utilisateur, 'model'=>$personnel])
@section('personnel')
    <div>
        <label for="" class="label">Statut : </label>
        <div class="flex space-x-3">
            {{-- dd($personnel->statut) --}}
            <div class="flex space-x-1">
                <input type="radio" name="statut" value="Bibliothécaire" {{ $personnel->statut == "Bibliothécaire" ? "checked" : "" }}/>
                <label class="label">Bibliothècaire</label>
            </div>
            <div class="flex space-x-1">
                <input type="radio" name="statut" value="Responsable" {{ $personnel->statut == "Responsable" ? "checked" : "" }}/>
                <label class="label">Responsable</label>
            </div>
        </div>
    </div>
@endsection

