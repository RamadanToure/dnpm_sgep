<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accusé de réception</title>
</head>
<body>
    <p>Bonjour {{ $requestData->user->name }},</p>

    <p>Nous avons bien reçu votre demande d'agrément pour un établissement de type : {{ $requestData->type_etablissement }}.</p>

    <p>Votre demande est en cours de traitement. Nous vous informerons de toute mise à jour.</p>

    <p>Cordialement,</p>
    <p>Le Ministère de la Santé</p>
</body>
</html>
