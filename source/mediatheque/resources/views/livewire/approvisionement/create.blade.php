<div>
    <fieldset>
        <legend>Personnel</legend>
        <div>
            <div>
                <label for="noms_personnel">Nom</label>
                <select wire:model="selected_id_personnel" name="id_personnel" id="noms_personnel">
                    <option value="">--Sélectionner nom--</option>
                    @foreach($personnels as $personnel)
                        <option value="{{ $personnel->utilsateur->id_utilisateur }}">{{ $personnel->utilisateur->nom }}</option>
                    @endforeach
                </select>
                {{ $selected_id_personnel }}
            </div>
            <div>
                <label for="prenom_personnel">Prenom</label>
                <select name="prenom_personnel" id="prenom_personnel">
                    <option value="">--Sélectionner prénom--</option>
                    @foreach($prenoms as $prenom)
                        <option value="{{ $prenom }}">{{ $prenom }}</option>
                    @endforeach
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
                            <input type="search" name="ouvrage_physique" id="searche_ouvrgae_physique" placeholder="rechercher"/>
                            <input name="ouvrage_physique_cle" id="searche_ouvrgae_physique_cle" value="">
                        </div>
                        <div class="overflow-y-auto h-32">
                            <ul id="searche_options">
                                @foreach($ouvragesPhysique as $ouvragePhysique)
                                    <li class="ouvrages_physique bg-white hover:text-gray-400" id="{{ $ouvragePhysique->id_ouvrage_physique }}, {{ $ouvragePhysique->ouvrage->auteurs->first()->pivot->annee_apparution }}">
                                        {{ $ouvragePhysique->ouvrage->titre }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <label for="annee_apparution">Annee de parution</label>
                <input type="text" name="annee_apparution" id="annee_apparution" value="">
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
