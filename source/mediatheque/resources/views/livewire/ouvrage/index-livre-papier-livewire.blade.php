<div>
    <h1> Livres papier </h1>
    <div>
        <form>
            <ul id="searchModTabs">
                <li class="active">
                    <a class="change_search_mode" href="">Recherche génerale</a>
                </li>
                <li class="">
                    <a class="change_seache_mode" href="">Recherche plien text</a>
                </li>
            </ul>
            <div class="">
                <div class="input">
                    <input wire:model="search" type="text" name="text" id="searchFieldx" placeholder="Recherche par titre" autocomplete="false">
                    <button type="submit">Rechercher</button>
                    {{ $search }}
                </div>
            </div>
            <div class="" id="searchParametersField">
                <p>Paramètre de recherche</p>
                <div>
                    <select name="annee_parution_debut">
                        <option value="all">Toute annee</option>
                    </select>
                    <label>-</label>
                    <select name="annee_parution_fin">
                        <option value="all">Toute annee</option>
                    </select>
                    <select name="langue">
                        <option value="all">Toute langue</option>
                    </select>
                    <select name="type">
                        <option value="all">Tous type</option>
                    </select>
                    <select name="domaine">
                        <option value="all">Tous domaine</option>
                    </select>
                    <select name="niveau">
                        <option value="all">Toute niveau</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div>
        <td>
            <form action="{{route('formulaireEnregistrementLivrePapier')}}" method="get">
                @csrf
                <input type="submit" name="ajouter" value="ajouter">
            </form>
        </td>
        <td>
            <form action="{{route('formulaireEnregistrementApprovisionnement')}}" method="get">
                @csrf
                <input type="submit" name="approvisionnement" value="Approvisionner">
            </form>
        </td>
    </div>
    <div>
        <select  id="par_page">
            @for($i = 5; $i <= 25; $i = $i+5)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <label for="par_page">par page</label>
    </div>
    @if(!empty($livresPapiers ?? "") && $livresPapiers->count())
        <table border="1">
            <thead>
            <th>Numéro</th>
            <th>Titre</th>
            <th>Niveau</th>
            <th>Type</th>
            <th>Domaine</th>
            <th>Langue</th>
            <th>Nombre d'exemplaire</th>
            <th>Disponibilité</th>
            <th>ISBN</th>
            <th>Action</th>
            </thead>
            <tbody>
            @foreach($livresPapiers as $livresPapier)
                <tr>
                    <td>{{ $livresPapier["id_livre_papier"] }}</td>
                    <td> {{ $livresPapier["titre"] }} </td>
                    <td> {{ $livresPapier["niveau"] }} </td>
                    <td> {{ $livresPapier["type"] }} </td>
                    <td> {{ \App\Helpers\LivrePapierHelper::showArray($livresPapier["categorie"]) }} </td>
                    <td> {{ $livresPapier["langue"] }} </td>
                    <td> {{ $livresPapier["nombre_exemplaire"] }} </td>
                    <td> {{ $livresPapier["disponibilite"] }} </td>
                    <td> {{ $livresPapier["ISBN"] }} </td>
                    <td>
                        <div>
                            <div>
                                <form action="{{route('affichageLivrePapier', $livresPapier["instance"])}}" method="get">
                                    @csrf
                                    <input type="submit" name="consulter" value="Consulter">
                                </form>
                            </div>
                        </div>
                        <form action="{{route('formulaireModificationLivrePapier', $livresPapier["instance"])}}" method="get">
                            @csrf
                            <input type="submit" name="editer" value="Éditer">
                        </form>
                        <form action="{{route('suppressionLivrePapier', $livresPapier["instance"])}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" name="supprimer" value="Supprimer">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h3>Il n'y a aucun ouvrage.</h3>
    @endif
    {--!! $livresPapiers->links() !!--}
</div>
