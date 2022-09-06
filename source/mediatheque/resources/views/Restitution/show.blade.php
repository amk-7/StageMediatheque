@extends("layout.base")
@section("content")
    <main>
        <h4>Avoir des methodes changementEtat et retardRestitution</h4>
        <div>
            <h1>Restitution N° {{ $restitution->id_restitution }}</h1>
            <h2>Abonne : {{ $restitution->abonneFullName }} </h2>
            <h2>Personnel : {{ $restitution->personnelFullName }} </h2>
            <h2>Date : {{ $restitution->date_restitution }} </h2>
        </div>
        <div>
            <table border="1">
                <thead>
                <tr>
                    <th>Numero</th>
                    <th>Titre ouvrage</th>
                    <th>Etat ouvrage</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($restitution->ouvragePhysiques as $restitutionOuvrage)
                        <tr>
                            <td> {{ $loop->index+1 }} </td>
                            <td> {{ $restitutionOuvrage->ouvrage->titre }} </td>
                            <td> {{ \App\Helpers\OuvragesPhysiqueHelper::afficherEtat($restitutionOuvrage->pivot->etat_ouvrage) }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
