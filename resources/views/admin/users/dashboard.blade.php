@extends('layouts.app')

@section('content')
<div>
    <h1 class="h3 mt-5 mb-4 text-gray-800">MES DEMANDES</h1>
    <div class="row">
        <div class="col-lg-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">


                <div class="card-body">
                    <!-- Display flexible analysis results here -->
                    <!-- Example: -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-header-blue">
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>N°</th>
                                    <th class="text-center">Date Enregistrement</th>
                                    <th>Nom et Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Nom de l'Etablissement</th>
                                    <th>Inscription à L'ordre</th>
                                    {{-- <th>Réf. Diplôme</th>
                                    <th>Site Souhaite</th> --}}
                                    <th> Type de Demande</th>
                                    <th>Type d'établissement</th>
                                    <th class="text-center">Document</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userRequests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($request->created_at)->isoFormat('DD MMMM YYYY', 'Do MMMM YYYY', 'fr') }}</td>
                                    <td>{{ $request->nom }} {{ $request->prenoms }}</td>
                                    <td>{{ $request->contact}}</td>
                                    <td>{{ $request->email}}</td>
                                    <td>{{ $request->nom}}</td>
                                    {{-- <td>{{ $request->ref_op}}</td>
                                    <td>{{ $request->ref_diplome}}</td> --}}
                                    <td>{{ $request->site}}</td>
                                    <td>{{ $request->requestType->name }}</td>
                                    <td>{{ $request->etablissementType->name }}</td>
                                    <td class="text-center">{{ $request->status }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#documentModal{{ $demande->id }}">
                                            <i class="fas fa-file"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="documentModal{{ $demande->id }}" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="documentModalLabel">Document de la demande</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Vérifiez si la demande a un document -->
                                                        @if ($demande->document)
                                                            <!-- Affichez le document ici -->
                                                            <embed src="{{ asset('storage/' . $demande->document->file_path) }}" width="100%" height="500px" frameborder="0">
                                                        @else
                                                            <p>Aucun document associé à cette demande.</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetails{{ $request->id }}">Détails</button>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $request->id }}">Modifier</button>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modale pour les détails de la demande -->
@foreach($userRequests as $request)
<div class="modal fade" id="modalDetails{{ $request->id }}" tabindex="-1" aria-labelledby="modalDetailsLabel{{ $request->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailsLabel{{ $request->id }}">Détails de la demande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Affichez les détails de la demande ici -->
                <!-- Exemple : -->
                <p>Date de soumission : {{ $request->created_at }}</p>
                <p>Nom et Prénom : {{ $request->nom }} {{ $request->prenoms }}</p>
                <!-- Ajoutez d'autres détails si nécessaire -->
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modale pour la modification de la demande -->
@foreach($userRequests as $request)
<div class="modal fade" id="modalEdit{{ $request->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $request->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel{{ $request->id }}">Modifier la demande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire de modification de la demande ici -->
                <!-- Exemple : -->
                <form action="{{ route('requests.update', $request->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Ajoutez les champs de modification de la demande ici -->
                    <!-- Exemple : -->
                    <div class="                    mb-3">
                        <label for="nom" class="form-label">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ $request->nom }}">
                    </div>
                    <!-- Ajoutez d'autres champs si nécessaire -->
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

