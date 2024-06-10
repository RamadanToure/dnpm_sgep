@extends('layouts.app')

@section('content')
<div>
    <h1 class="h3 mt-5 mb-4 text-gray-800">Détails de la Demande</h1>
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Demande de : {{ $demande->user->name }}</h6>
                </div>
                <div class="card-body">
                    <p><strong>Nom de l'Utilisateur:</strong> {{ $demande->user->name }}</p>
                    <p><strong>Nom et Prénoms:</strong> {{ $demande->nomPrenoms }}</p>
                    <p><strong>Contact:</strong> {{ $demande->contact }}</p>
                    <p><strong>Email:</strong> {{ $demande->email }}</p>
                    <p><strong>Type d'établissement:</strong> {{ $demande->etablissementType->name }}</p>
                    <p><strong>Type de Demande:</strong> {{ $demande->requestType->name  }}</p>
                    <p><strong>Statut:</strong> {{ $demande->status }}</p>
                    <p><strong>Étape de traitement:</strong> {{ $demande->etape }}</p>
                    <p><strong>Région:</strong> {{ $demande->region->name }}</p>
                    <p><strong>Préfecture:</strong> {{ $demande->prefecture->name }}</p>
                    <p><strong>Date de Soumission:</strong> {{ \Carbon\Carbon::parse($demande->created_at)->isoFormat('DD MMMM YYYY', 'Do MMMM YYYY', 'fr') }}</p>
                </div>
                <!-- Bouton transformé en icône -->

            </div>
            <div class="mb-4">
                <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#traiterDemandeModal">
                    <i class="fas fa-cogs"></i> Traitement
                </button>
                <a href="{{ route('demande.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-0">
                    <h6 class="m-0 font-weight-bold text-primary">Documents Requis</h6>
                </div>
                <div class="modal-body">
                    @if ($demande->document)
                        <embed src="{{ asset('storage/' . $demande->document->file_path) }}" width="100%" height="500px" frameborder="0">
                    @else
                        <p>Aucun document associé à cette demande.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Historique des Modifications</h6>
                </div>
                <div class="card-body">
                    <ul>
                        @if(isset($demande->modifications) && count($demande->modifications) > 0)
                            @foreach ($demande->modifications as $modification)
                                <li>{{ $modification->created_at }} - {{ $modification->action }} par {{ $modification->user->name }}</li>
                            @endforeach
                        @else
                            <li>Aucune modification pour cette demande.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour traiter la demande -->
<div class="modal fade" id="traiterDemandeModal" tabindex="-1" role="dialog" aria-labelledby="traiterDemandeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="traiterDemandeModalLabel">Traitement de la Demande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire pour changer le statut et transférer la demande -->
                <form action="{{ route('demande.traiter', $demande->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="utilisateur"><b>Transférer à :</b></label>
                        <select name="utilisateur" id="utilisateur" class="form-control">
                            @foreach ($utilisateurs as $utilisateur)
                                <option value="{{ $utilisateur->id }}">{{ $utilisateur->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="statut"><b>Changer le statut </b>:</label>
                        <select name="statut" id="statut" class="form-control">
                            <option value="en_attente">En attente</option>
                            <option value="traitee">Traitée</option>
                            <option value="refusee">Refusée</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="commentaire">Ajouter un commentaire :</label>
                        <textarea name="commentaire" id="commentaire" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fichier">Joindre un fichier :</label>
                        <input type="file" name="fichier" id="fichier" class="form-control-file">
                    </div>
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
