@extends('layout.user.userCreate', ['action'=>"storePersonnel", 'title'=>"Ajouter un personnel"])

@section('personnel')
    <div>
        <label for="statut">Statut</label>
            <input type="text" class="form-control" id="statut" name="statut" class="@error('statut') is-invalid @enderror">
            @error('statut')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>
@endsection

