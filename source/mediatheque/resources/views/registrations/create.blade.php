@extends('layout.template.base')

@section('content')
<div>
    <h1>Registrations</h1>
    <form action="" method="">
       <fieldset>
           <legend>Abonne</legend>
           <label>
               <span>Nom: </span>
               <span></span>
           </label>
           <label>
               <span>Prenom: </span>
               <span></span>
           </label>
       </fieldset>
        <fieldset>
            <legend>Abonnement</legend>
            <label>
                <span>Type: </span>
                <span>Scolaire</span>
            </label>
            <label>
                <span>Montant: </span>
                <span>200 FCFA</span>
            </label>
            <div>
                <label>
                    <span>Payé: </span>
                </label>
                <div>
                    <input type="radio" name="paye" value="oui">Oui</input>
                    <input type="radio" name="paye" value="nom">Non</input>
                </div>
            </div>
        </fieldset>
        <input type="submit" value="Enregistré">
    </form>
</div>
@endsection
