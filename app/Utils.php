<?php

// app/Helpers/Utils.php

if (!function_exists('getStatusClass')) {
    function getStatusClass($statut)
    {
        switch ($statut) {
            case 'valide':
                return 'table-success'; // Vert
            case 'rejete':
                return 'table-danger'; // Rouge
            case 'en_attente':
                return 'table-warning'; // Autre couleur (par exemple, jaune)
            default:
                return ''; // Aucune classe par défaut
        }
    }
}
