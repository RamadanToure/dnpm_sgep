<?php

namespace App\Http\Controllers;

use App\Mail\AccuseReceptionMail;
use App\Models\Document;
use App\Models\Demande;
use App\Models\Comment;
use App\Models\EtablissementType;
use App\Models\EtapeProcessus;
use App\Models\RequestType;
use App\Models\User;
use App\Models\Region;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DemandeController extends Controller
{
    protected $regions;
    protected $prefectures;

    // public function __construct()
    // {
    //     $this->middleware('auth');

    //     $this->regions = Region::pluck('name', 'id');
    //     $this->prefectures = Prefecture::pluck('name', 'id');
    // }

    // Analyse des demandes par région et préfecture
    public function analysis(Request $request)
    {
        $regionId = $request->input('region_id');
        $prefectureId = $request->input('prefecture_id');

        $query = Demande::query();

        if ($regionId) {
            $query->where('region_id', $regionId);
        }

        if ($prefectureId) {
            $query->where('prefecture_id', $prefectureId);
        }

        $demandes = $query->paginate(10);

        return view('admin.flexible_analysis', [
            'demandes' => $demandes,
            'regions' => $this->regions,
            'prefectures' => $this->prefectures,
        ]);
    }

    // Liste les demandes avec filtrage
    public function index(Request $request)
    {
        $typeEtablissement = $request->input('etablissement_type');
        $status = $request->input('status');
        $search = $request->input('search');
        $telephone = $request->input('telephone');
        $region = $request->input('region');
        $prefecture = $request->input('prefecture');

        $query = Demande::query();

        if ($typeEtablissement) {
            $query->where('etablissement_type_id', $typeEtablissement);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', '%' . $search . '%')
                  ->orWhere('prenoms', 'like', '%' . $search . '%');
            });
        }

        if ($telephone) {
            $query->where('contact', 'like', '%' . $telephone . '%');
        }

        if ($region) {
            $query->whereHas('region', function ($q) use ($region) {
                $q->where('name', $region);
            });
        }

        if ($prefecture) {
            $query->whereHas('prefecture', function ($q) use ($prefecture) {
                $q->where('name', $prefecture);
            });
        }

        $demandes = $query->paginate(10);

        return view('admin.demande.index', [
            'demandes' => $demandes,
            'requestTypes' => RequestType::all(),
            'etablissementTypes' => EtablissementType::all(),
            'regions' => $this->regions,
            'prefectures' => $this->prefectures,
        ]);
    }

    // Affiche le formulaire de création de demande
    public function create()
    {
        return view('admin.demande.create', [
            'requestTypes' => RequestType::all(),
            'etablissementTypes' => EtablissementType::all(),
            'regions' => $this->regions,
            'prefectures' => $this->prefectures,
        ]);
    }

    // Enregistre une nouvelle demande
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'prenoms' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'etablissement_type_id' => 'required',
            'region_id' => 'required',
            'prefecture_id' => 'required',
        ]);

        $demande = new Demande($validatedData);
        $demande->user_id = Auth::id();
        $demande->save();

        return redirect()->route('demande.index')->with('success', 'Demande créée avec succès.');
    }

    // Traiter une demande
    public function traiter(Request $request, $id)
    {
        $demande = Demande::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'required|string|in:Reçu,traitee,refusee',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $demande->update($validatedData);

        return redirect()->route('demande.show', $demande->id)->with('success', 'Demande traitée avec succès !');
    }

    // Affiche les détails d'une demande spécifique
    public function show(Demande $demande)
    {
        return view('admin.demande.show', [
            'demande' => $demande,
            'utilisateurs' => User::all(),
        ]);
    }

    // Affiche le formulaire pour éditer une demande
    public function edit($id)
    {
        $demande = Demande::findOrFail($id);
        return view('admin.demande.edit', compact('demande'));
    }

    // Met à jour une demande existante
    public function update(Request $request, Demande $demande)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'prenoms' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'etablissement_type_id' => 'required',
            'region_id' => 'required',
            'prefecture_id' => 'required',
        ]);

        $demande->update($validatedData);

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
            switch ($action) {
                case 'approve':
                    $demande->update(['status' => 'approuvé']);
                    break;
                case 'reject':
                    $demande->update(['status' => 'rejeté']);
                    break;
                case 'delete':
                    $demande->delete();
                    break;
            }
        }

        return redirect()->route('demande.index')->with('success', 'Actions groupées effectuées avec succès.');
    }

    // Soumission de demande avec envoi d'email
    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'etablissement_type_id' => 'required',
            'nomPrenoms' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'email' => 'required|email',
            'nom' => 'required|string|max:255',
            'region_id' => 'required',
            'prefecture_id' => 'required',
            'documents.*' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $demande = new Demande($validatedData);
        $demande->user_id = Auth::id();
        $demande->save();

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('documents', 'public');
                Document::create([
                    'demande_id' => $demande->id,
                    'file_path' => $path,
                ]);
            }
        }

        try {
            Mail::to($demande->email)->send(new AccuseReceptionMail($demande));
        } catch (\Exception $e) {
            DB::table('demandes_en_attente')->insert([
                'etablissement_type' => $demande->etablissement_type_id,
                'user_id' => $demande->user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('demande.index')->with('warning', 'Demande créée avec succès, mais l\'accusé de réception n\'a pas pu être envoyé en raison d\'un problème de connexion.');
        }

        return redirect()->route('demande.index')->with('success', 'Demande créée avec succès et l\'accusé de réception a été envoyé.');
    }

    // Transfert d'une demande à un autre utilisateur
    public function transfer(Request $request, Demande $demande)
    {
        $validatedData = $request->validate([
            'assigned_user_id' => 'required|exists:users,id',
        ]);

        $demande->update([
            'assigned_user_id' => $validatedData['assigned_user_id'],
        ]);

        return redirect()->route('demande.show', $demande->id)->with('success', 'Demande transférée avec succès !');
    }
}
