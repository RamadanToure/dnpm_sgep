<p>Bonjour {{ $requestData->user->name }},</p>

<p>Votre demande d'agrément pour un établissement de type : {{ $requestData->type_d_etablissement }} a été mise à jour.</p>

<p>Statut actuel : {{ $requestData->statut }}</p>
<p>Étape actuelle : {{ $requestData->etape }}</p>

<p>Cordialement,</p>
<p>Le Ministère de la Santé</p>
