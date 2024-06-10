<?php

namespace App\Http\Controllers;

use App\Models\EtablissementType;
use App\Models\Prefecture;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Request as Demande; // Renommez le modèle Request pour éviter les conflits
use App\Models\RequestType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Accès non autorisé.');
        }

        $allRequests = Demande::latest()->paginate(10);
        $nombreDeTransferts = Demande::count();
        $etablissementsParCategorie = Demande::join('etablissement_types', 'requests.etablissement_type_id', '=', 'etablissement_types.id')
            ->select('etablissement_types.name as etablissement_type', DB::raw('COUNT(requests.id) as count'))
            ->groupBy('etablissement_types.name')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->etablissement_type => $item->count];
            })
            ->toArray();
            $etablissementsParRegion = Demande::join('regions', 'requests.region_id', '=', 'regions.id')
            ->select('regions.name as region', DB::raw('COUNT(*) as count'))
            ->groupBy('regions.name')
            ->pluck('count', 'region')
            ->toArray();
        $totalDemandesCreation = Demande::where('status', 'en_attente')->count();

        return view('dashboard', compact('allRequests', 'nombreDeTransferts', 'etablissementsParCategorie', 'etablissementsParRegion', 'totalDemandesCreation'));
    }

    public function adminDashboard()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Accès non autorisé.');
        }

        return $this->index();
    }

public function userDashboard()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à votre tableau de bord.');
    }

    $user = Auth::user();
    $userRequests = $user->requests()->latest()->get();
    $etablissementsParCategorie = DB::table('requests')
        ->join('etablissement_types', 'requests.etablissement_type_id', '=', 'etablissement_types.id')
        ->select('etablissement_types.name as etablissement_type', DB::raw('COUNT(requests.id) as count'))
        ->groupBy('etablissement_types.name')
        ->get()
        ->mapWithKeys(function ($item) {
            return [$item->etablissement_type => $item->count];
        })
        ->toArray();
    $etablissementsParRegion = Demande::join('regions', 'requests.region_id', '=', 'regions.id')
        ->select('regions.name as region', DB::raw('COUNT(*) as count'))
        ->groupBy('regions.name')
        ->pluck('count', 'region')
        ->toArray();



    $user = Auth::user(); // Récupérer l'utilisateur connecté
    $userEmail = $user->email; // Récupérer l'email de l'utilisateur connecté
    $regions = Region::all();
    $prefectures = Prefecture::all();
    $requestTypes = RequestType::all();
    $etablissementTypes = EtablissementType::all();
    $nombreDeTransferts = Demande::count();

    $totalDemandesCreation = Demande::where('status', 'en_attente')->count();
    $anotherData = 0;

    return view('user_dashboard', compact('user', 'userEmail', 'userRequests', 'etablissementsParCategorie', 'etablissementsParRegion', 'nombreDeTransferts', 'totalDemandesCreation', 'anotherData',
    'requestTypes', 'etablissementTypes','regions', 'prefectures'));
}

}
