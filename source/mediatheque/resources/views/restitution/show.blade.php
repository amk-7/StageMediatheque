@extends("layout.base")
@section("content")
    <main>
        <h4>Avoir des methodes changementEtat et retardRestitution</h4>
        <div>
            <h1>Restitution N° {{ $restitution->id_restitution }}</h1>
            <h2>Abonne : {{ $restitution->abonne->utilisateur->userFullName }} </h2>
            <h2>Personnel : {{ $restitution->personnel->utilisateur->userFullName }} </h2>
            <h2>Date : {{ $restitution->date_restitution }} </h2>
        </div>
        <div>
            <table border="1" id="liste_restitution">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Cote</th>
                    <th>Titre ouvrage</th>
                    <th>Etat sortie</th>
                    <th>Etat entrée</th>
                    <th>Restituer</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </main>
@endsection
@section("js")
    <script type="text/javascript" async>

        let number = 1;
        let id_emprunt = {!! $restitution->emprunt->id_emprunt !!};
        let lignes_emprunt = {!! $lignes_emprunt !!};

        mettreLignesEmprunt();

        function stopPropagation(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function mettreLignesEmprunt(){
            for (let i = 0; i < lignes_emprunt.length; i++) {
                mettreUneLigneEmprunt(lignes_emprunt[i]['cote'], lignes_emprunt[i]['titre_ouvrage'], lignes_emprunt[i]['etat_sortie'], lignes_emprunt[i]['disponibilite'], lignes_emprunt[i]['etat_entree']);
            }
        }

        function mettreUneLigneEmprunt(cote, titre_ouvrage, etat_sortie, disponibilite, etat_entree){
            let table_body = document.getElementById('liste_restitution').children[1];
            let row = document.createElement('tr');
            let cell_number = document.createElement('td');
            let cell_cote = document.createElement('td');
            let cell_ouvrage = document.createElement('td');
            let cell_etat_sortie = document.createElement('td');
            let cell_etat_entree = document.createElement('td');
            let cell_restituer = document.createElement('td');

            if (! disponibilite){
                cell_restituer.innerText = "Nom restituer";
                cell_etat_entree.innerText = "-";
            } else {
                cell_restituer.innerText = "Restituer";
                cell_etat_entree.innerText = etat_entree;
            }

            cell_number.innerText = number;
            cell_cote.innerText = cote;
            cell_ouvrage.innerText = titre_ouvrage;
            cell_etat_sortie.innerText = etat_sortie;

            number++;

            row.appendChild(cell_number);
            row.appendChild(cell_cote);
            row.appendChild(cell_ouvrage);
            row.appendChild(cell_etat_sortie);
            row.appendChild(cell_etat_entree);
            row.appendChild(cell_restituer);
            table_body.appendChild(row);
        };
    </script>
@stop
