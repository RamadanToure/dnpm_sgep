<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EtablissementTypeController;
use App\Http\Controllers\PrefectureController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RequestTypeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin_dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/flexible-analysis', [RequestController::class, 'flexibleAnalysis'])->name('request.flexibleAnalysis');
});

// Route pour le tableau de bord public (ou utilisateur standard)
Route::middleware(['auth'])->group(function () {
    Route::get('/public_dashboard', [PublicController::class, 'publicDashboard'])->name('public_dashboard');
});
Route::resource('users', UserController::class);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    // Routes pour la gestion des utilisateurs
    Route::prefix('admin')->name('admin.')->group(function () {

    });
});

// Routes resource pour gérer toutes les actions CRUD de base pour les demandes
Route::middleware(['auth'])->group(function () {
    Route::resource('demande', RequestController::class);
});

Route::get('/home', [PublicController::class, 'home'])->name('home');
Route::get('/offine', [PublicController::class, 'offine'])->name('offine');
Route::get('/industrie', [PublicController::class, 'industrie'])->name('industrie');
Route::get('/agence', [PublicController::class, 'agence'])->name('agence');
Route::get('/officine', [PublicController::class, 'officine'])->name('officine');
Route::get('/grossiste', [PublicController::class, 'grossiste'])->name('grossiste');

// Routes spécifiques pour les actions de transfert et de traitement des demandes
Route::middleware(['auth'])->group(function () {
    Route::post('/demande/{demande}/transfer', [RequestController::class, 'transfer'])->name('demande.transfer');
    Route::get('/analysis', [RequestController::class, 'analysis'])->name('analysis');
});

// Route pour la soumission de demande
Route::middleware(['auth'])->group(function () {
    Route::post('/demande/submit', [RequestController::class, 'submit'])->name('demande.submit');
    Route::put('/requests/{id}', [RequestController::class, 'update'])->name('requests.update');
});

// Routes pour traiter et commenter les demandes
Route::middleware(['auth'])->group(function () {
    Route::post('/demande/{id}/traiter', [RequestController::class, 'traiter'])->name('demande.traiter');
    Route::post('/demande/{id}/commenter', [RequestController::class, 'commenter'])->name('demande.commenter');
});

// Route pour les actions groupées
Route::middleware(['auth'])->group(function () {
    Route::post('/demande/bulkAction', [RequestController::class, 'bulkAction'])->name('demande.bulkAction');
});

Route::resource('etablissementTypes', EtablissementTypeController::class);
Route::resource('request_types', RequestTypeController::class);

Route::resource('regions', RegionController::class);
Route::resource('prefectures', PrefectureController::class);

require __DIR__.'/auth.php';
