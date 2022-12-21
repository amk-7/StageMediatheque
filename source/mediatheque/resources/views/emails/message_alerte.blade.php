<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALERT RESTITUTION</title>
</head>
<body>
    <h1 class="bg-red-600">ALERT RESTITUTION</h1><br/>
    <p>
        Bonjour Mr {{ $datas['nom']." ".$datas['prenom'] }} l'emprunt des ouvrages dont vous benéficier est présque à son terme. Vous
        êtes prier de restituer ces ouvrages demain le {{ $datas['date_retour'] }} à la médiathèque. <br/>
        Ouvrages emprunté :
        <ul>
            @foreach($datas['ouvrages'] as $o)
                <li>{{ $o }}</li>
            @endforeach
        </ul>
    </p>
</body>
</html>
