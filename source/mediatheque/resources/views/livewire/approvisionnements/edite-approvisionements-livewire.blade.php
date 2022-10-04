<div>
    <h1>Edition d'un ouvrage</h1>
    <form action="{{ route('enregistementApprovisionnement') }}" method="post">
        @csrf
        <fieldset>
            <legend>Personnel</legend>
            <div>
                <label for="nom_personne">Nom</label>
                <select wire:model="nom_personne" name="nom_personne" id="nom_personne">
                    <option value="">--Selectionner nom--</option>
                    @foreach($personnels as $personnel)
                        <option value="{{ $personnel->utilisateur->nom }}" {{ $personnel->utilisateur->nom == $approvisionnement->personnel->utilisateur->nom ? 'selected' : '' }}>
                            {{ $personnel->utilisateur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="prenom_personne">Prenom</label>
                <select name="id_personnel" id="prenom_personne">
                    <option value="">--Selectionner prenom--</option>
                    @foreach($prenoms_personnes as $personnel)
                        <option value="{{ $personnel->id_personnel }}">{{ $personnel->prenom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="date_approvisionement">Date</label>
                <input type="date" name="date_approvisionnement" id="date_approvisionnement" value="{{ $date_approvisionnement }}">
            </div>
        </fieldset>
        <fieldset>
            <legend>Ouvrage</legend>
            <div>
                <label for="type_ouvrage">Type de l'ouvrage</label>
                <select wire:model="type_ouvrage" name="type_ouvrage" id="type_ouvrage">
                    <option value="">--Séléctionner type--</option>
                    <option value="livre_papier">Livre papier</option>
                    <option value="document_audio_visuel">Document audio visuel</option>
                </select>
            </div>
            <div>
                <label for="ouvrage_code_id">Identifiant</label>
                <input wire:model="ouvrage_code_id" type="text" name="ouvrage_code_id" id="ouvrage_code_id" placeholder="Saisire l'idendifiant (ISBN ou ISAN).">
            </div>
            <div>
                <label for="titre_ouvrage">Titre</label>
                <input wire:model="titre" wire:click="searchOuvragePysique" type="text" name="titre_ouvrage" id="titre_ouvrage" placeholder="Cliker pour afficher l'ouvrge.">
                <input wire:model="id_ouvrage" name="id_ouvrage" type="number">
            </div>
            <div>
                <label for="nb_exemplaire">Nombre d'exemplaire</label>
                <input type="number" name="nombre_exemplaire" id="nombre_exemplaire" placeholder="Saisire le nombre d'exemplaire.">
            </div>
        </fieldset>
        <input type="submit" name="action_approvisionnement" value="Approvisionner">
    </form>
</div>
