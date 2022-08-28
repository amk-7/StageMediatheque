<div>
    <fieldset>
        <legend>Personnel</legend>
        <div>
            <div>
                <label for="noms_personnel">Nom</label>
                <select name="id_personnel" id="noms_personnel">
                    <option value="">--Sélectionner nom--</option>
                </select>
            </div>
            <div>
                <label for="prenom_personnel">Prenom</label>
                <select name="prenom_personnel" id="prenom_personnel">
                    <option value="">--Sélectionner prénom--</option>
                </select>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Ouvrage</legend>
        <div>
            <div>
                <label for="ouvrages">Titre</label>
                <div>
                    <div class="select-btn">
                        <span>selectionner l'ouvrage</span>
                        <i class="uil uil-angle-down"></i>
                    </div>
                    <div class="search_in_content">
                        <div class="search_option">
                            <input type="search" name="ouvrage_physique_0" id="ouvrgae_physique" placeholder="rechercher"/>
                        </div>
                        <ul>
                            @foreach($ouvragesPhysique as $ouvragePhysique)
                                <option value="{{ $ouvragePhysique->id_ouvrage_physique }}"><li>{{ $ouvragePhysique->ouvrage->titre }}</li></option>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <label for="annees">Annee de parution</label>
                <select name="annee" id="annee">
                    <option value="">--Sélectionner ouvrage--</option>
                </select>
            </div>
        </div>
        <div>
            <div>
                <label for="nombre_examplaire">Nombre d'exemplaire</label>
                <input type="number" name="nombre_examplaire" id="nombre_examplaire">
            </div>
            <div>
                <label for="date_approvisionnement">Date</label>
                <input type="date" name="date_approvisionnement" id="date_approvisionnement" value="">
            </div>
        </div>
    </fieldset>
</div>
