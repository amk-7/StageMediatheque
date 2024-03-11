<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue à la Médiathèque Sokodé !</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">

        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; text-align: center;">
            <div style="display: flex; max-width: 100%; margin: 20px;">
                <img src="http://uf-mediathequesokode.org/storage/images/logo.png" alt="Logo de Urbis Foundation" style="max-width: 70%; margin-bottom: 20px;">
                <img width="100px" src="http://uf-mediathequesokode.org/storage/images/logo2.png" alt="Logo de la Médiathèque Sokodé" style="max-width: 30%; margin-bottom: 20px;">
            </div>
            <h1 style="color: #008814;">Alerte Emprunt !</h1>
            <!-- Le reste du contenu reste inchangé ... -->
        </div>

        <p>Cher(e) {{ $user }},</p>

        <p>Nous tenons à vous informer que la date limite d'emprunt pour l'ouvrage <strong>[Titre de l'Ouvrage]</strong> est arrivée. Merci de retourner l'ouvrage dès que possible.</p>

        <p>Voici les détails de l'emprunt :</p>
        <ul>
            <li><strong>Titre de l'Ouvrage :</strong> {{ $ouvrages }} </li>
            <li><strong>Date d'Emprunt :</strong> {{ $date_emprunt }} </li>
            <li><strong>Date Limite :</strong> {{ $date_retour }} </li>
        </ul>

        <p>Nous vous rappelons que les retards peuvent entraîner des frais supplémentaires. Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter.</p>

        <p>Nous vous remercions de votre coopération.</p>

        <p>Cordialement,</p>
        <p>L'équipe de la Médiathèque Sokodé</p>
        <p> + 228 25 50 14 40 </p>
        <p> + 228 90 91 58 25 </p>
        <p> + 228 90 78 04 06 </p>
    </div>
</body>
</html>
