<?php

namespace App\Http\Controllers;

use App\Mail\AccuseReceptionMail;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Request as Demande; // Renommer le modèle Request pour éviter les conflits
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\EtablissementType;
use App\Models\RequestType;
use App\Models\User;
use App\Models\Region; // Ajout du modèle Region
use App\Models\Prefecture; // Ajout du modèle Prefecture
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;



class RequestController extends Controller
{

    public function __construct()
    {
        // Appliquer le middleware auth et le middleware de redirection si l'utilisateur n'est pas authentifié
    }

// Analyse des demandes par région et préfecture
public function analysis(Request $request)
{
     // Récupération des régions et préfectures pour les options de sélection
     $regions = Region::pluck('name', 'id');
     $prefectures = Prefecture::pluck('name', 'id');

     // Récupération des paramètres de recherche
     $regionId = $request->input('region_id');
     $prefectureId = $request->input('prefecture_id');


    $query = \App\Models\Request::query();

    if ($regionId) {
        $query->where('region_id', $regionId);
    }

    if ($prefectureId) {
        $query->where('prefecture_id', $prefectureId);
    }

    $flexibleAnalysisResults = $query->get();
    $etablissements = $query->get();
    $regions = \App\Models\Region::select('name')->distinct()->pluck('name'); // Sélection de la colonne 'name' pour les régions
    $prefectures = \App\Models\Prefecture::select('name')->distinct()->pluck('name'); // Sélection de la colonne 'name' pour les préfectures

    // Exécution de la requête
    $demandes = $query->paginate(10);

    return view('admin.flexible_analysis', compact('flexibleAnalysisResults', 'etablissements', 'regions', 'prefectures'));
}

public function index(Request $request)
{
    $typeEtablissement = $request->input('etablissement_type');
    $status = $request->input('status');
    $search = $request->input('search'); // Ajout de la recherche par nom et prénom
    $telephone = $request->input('telephone'); // Ajout de la recherche par téléphone
    $region = $request->input('region'); // Ajout de la recherche par région
    $prefecture = $request->input('prefecture'); // Ajout de la recherche par préfecture

    $query = \App\Models\Request::query(); // Utilisation du nom complet du modèle

    if ($typeEtablissement) {
        $query->where('etablissement_type_id', $typeEtablissement);
    }

    if ($status) {
        $query->where('status', $status);
    }

    if ($search) {
        // Recherche par nom ou prénom
        $query->where(function ($q) use ($search) {
            $q->where('nom', 'like', '%' . $search . '%')
                ->orWhere('prenoms', 'like', '%' . $search . '%');
        });
    }

    if ($telephone) {
        // Recherche par numéro de téléphone
        $query->where('contact', 'like', '%' . $telephone . '%');
    }

    if ($region) {
        // Filtrer par région si une région est spécifiée
        $query->whereHas('region', function ($q) use ($region) {
            $q->where('name', $region); // Utilisation de la colonne 'name' pour la condition
        });
    }

    if ($prefecture) {
        // Filtrer par préfecture si une préfecture est spécifiée
        $query->whereHas('prefecture', function ($q) use ($prefecture) {
            $q->where('name', $prefecture); // Utilisation de la colonne 'name' pour la condition
        });
    }

    $demandes = $query->paginate(10);

    $requestTypes = \App\Models\RequestType::all();
    $etablissementTypes = \App\Models\EtablissementType::all();
    $regions = \App\Models\Region::all();
    $prefectures = \App\Models\Prefecture::all();

    return view('admin.demande.index', compact('demandes', 'requestTypes', 'etablissementTypes', 'regions', 'prefectures'));
}

    // Affiche le formulaire de création de demande
    public function create()
    {


        $requestTypes = RequestType::all();
        $etablissementTypes = EtablissementType::all();

        $regions = Region::all(); // Assurez-vous d'importer le modèle Region
        $prefectures = Prefecture::all(); // Assurez-vous d'importer le modèle Prefecture
        return view('admin.demande.create', compact('requestTypes', 'etablissementTypes', 'regions', 'prefectures'));
    }

    // Enregistre une nouvelle demande
// Enregistre une nouvelle demande
public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|email',
        'prenoms' => 'required|string|max:255',
        'contact' => 'required|string|max:255',
        'etablissement_type_id' => 'required',
        'region_id' => 'required',
        'prefecture_id' => 'required',
    ]);

    $demande = new Demande($request->all());
    $demande->user_id = Auth::id();
    $demande->save();

    // Vérifiez le rôle de l'utilisateur connecté
    if (Auth::user()->isAdmin()) {
        // Si l'utilisateur est un administrateur, redirigez-le vers la vue index pour l'administrateur
        return redirect()->route('admin.dashboard')->with('success', 'Demande soumise avec succès !');
    } else {
        // Sinon, redirigez-le vers le tableau de bord de l'utilisateur
        return redirect()->route('user.dashboard')->with('success', 'Demande soumise avec succès !');
    }
}


    // Traiter une demande
    public function traiter(Request $request, $id)
    {
        $demande = Demande::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:en_attente,traitee,refusee',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $demande->update($request->only('status', 'commentaire'));

        return redirect()->route('demande.show', $demande->id)->with('success', 'Demande traitée avec succès !');
    }

    // Affiche les détails d'une demande spécifique
    public function show(Demande $demande)
    {
        $utilisateurs = User::all();
        return view('admin.demande.show', compact('demande', 'utilisateurs'));
    }

    // Affiche le formulaire pour éditer une demande
    public function edit(Request $request, $id)
    {
        $demande = Demande::findOrFail($id);
        return view('admin.demande.edit', compact('demande'));
    }

    // Ajoute un commentaire à une demande
    public function commenter(Request $request, $id)
    {
        $request->validate([
            'commentaire' => $request->commentaire,
            'demande_id' => $id,
        ]);

        return redirect()->route('demande.show', $id)->with('success', 'Commentaire ajouté avec succès !');
    }

    // Met à jour une demande existante
    public function update(Request $request, Demande $demande)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'prenoms' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'etablissement_type_id' => 'required',
            'region_id' => 'required',
            'prefecture_id' => 'required',
        ]);

        $demande->update($request->all());

        return redirect()->route('demande.show', $demande->id)->with('success', 'Demande mise à jour avec succès !');
    }

    // Supprime une demande
    public function destroy(Demande $demande)
    {
        $demande->delete();
        return redirect()->route('demande.index')->with('success', 'Demande supprimée avec succès !');
    }

    // Gère les actions groupées
    public function bulkAction(Request $request)
    {
        $selectedIds = $request->input('selected', []);
        $action = $request->input('action');

        foreach ($selectedIds as $demandeId) {
            $demande = Demande::findOrFail($demandeId);
            if ($action === 'approve') {
                $demande->update(['status' => 'approuvé']);
            } elseif ($action === 'reject') {
                $demande->update(['status' => 'rejeté']);
            } elseif ($action === 'delete') {
                $demande->delete();
            }
        }

        return redirect()->route('demande.index')->with('success', 'Actions groupées effectuées avec succès');
    }

    // Soumission de demande avec envoi d'email
    public function submit(Request $request)
    {
        // Validation des données
        $request->validate([
            'etablissement_type_id' => 'required',
            'nomPrenoms' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'email' => 'required|email',
            'nom' => 'required|string|max:255',
            'region_id' => 'required',
            'prefecture_id' => 'required',
            'documents.*' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048'
        ]);

        // Récupération de l'utilisateur connecté
        $user_id = Auth::id();

        // Création de la demande
        $demande = new Demande($request->all());
        $demande->user_id = $user_id;
        $demande->save();

        // Enregistrement des documents associés à la demande
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('documents', 'public');
                $document = new Document();
                $document->request_id = $demande->id;
                $document->file_path = $path;
                $document->save();
            }
        }

        // Envoi de l'accusé de réception par email
        try {
            // Mail::to($demande->email)->send(new AccuseReceptionMail($demande));
        } catch (\Exception $e) {
            // En cas d'erreur lors de l'envoi de l'email, enregistrement de la demande en attente
            DB::table('demandes_en_attente')->insert([
                'etablissement_type' => $demande->etablissement_type,
                'user_id' => $demande->user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('demande.index')->with('warning', 'Demande créée avec succès, mais l\'accusé de réception n\'a pas pu être envoyé en raison d\'un problème de connexion. Votre demande sera traitée dès que possible.');
        }

        return redirect()->route('demande.index')->with('success', 'Demande créée avec succès et l\'accusé de réception a été envoyé.');
    }

    // Transfert d'une demande à un autre utilisateur
    public function transfer(Request $request, $demandeId)
    {
        $demande = Demande::findOrFail($demandeId);
        $utilisateurId = $request->input('utilisateur');
        $nouvelUtilisateur = User::findOrFail($utilisateurId);
        $demande->utilisateur_id = $nouvelUtilisateur->id;
        $demande->save();

        return redirect()->back()->with('success', 'Demande transférée avec succès à '.$nouvelUtilisateur->name);
    }
     // Méthode pour l'analyse flexible des demandes
     public function flexibleAnalysis(Request $request)
     {
         // Récupérer les régions et les préfectures pour les options de sélection
         $regions = Region::pluck('name', 'id');
         $prefectures = Prefecture::pluck('name', 'id');

         // Récupérer les paramètres de la requête
         $regionId = $request->input('region_id');
         $prefectureId = $request->input('prefecture_id');

         // Construire la requête en fonction des critères sélectionnés
         $query = Demande::query();

         if ($regionId) {
             $query->where('region_id', $regionId);
         }

         if ($prefectureId) {
             $query->where('prefecture_id', $prefectureId);
         }

         // Exécuter la requête
         $demandes = $query->paginate(10);

         // Retourner la vue avec les données nécessaires
         return view('admin.flexible_analysis', compact('demandes', 'regions', 'prefectures', 'regionId', 'prefectureId'));
     }

}

