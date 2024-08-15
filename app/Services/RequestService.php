<?php

namespace App\Services;

use App\Models\Request; // Assurez-vous que vous avez un modèle Request
use Exception;

class RequestService
{
    public function processRequest($data)
    {
        try {
            // Logique métier pour traiter une demande
            $request = new Request();
            $request->fill($data);
            $request->save();

            // Logique additionnelle si nécessaire
            return $request;

        } catch (Exception $e) {
            // Gérer les exceptions et erreurs
            throw new Exception("Erreur lors du traitement de la demande: " . $e->getMessage());
        }
    }

    public function transferRequest($requestId, $destination)
    {
        try {
            // Logique pour gérer les transferts
            $request = Request::findOrFail($requestId);
            $request->transfer_to($destination);  // Supposons que ce soit une méthode définie dans le modèle Request
            $request->save();

            return $request;

        } catch (Exception $e) {
            // Gérer les exceptions et erreurs
            throw new Exception("Erreur lors du transfert de la demande: " . $e->getMessage());
        }
    }
}
