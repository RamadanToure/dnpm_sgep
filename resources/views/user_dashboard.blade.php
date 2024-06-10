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
                                    <th class="text-center">Date Enregistrement</th>
                                    <th>Nom et Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Nom de l'Etablissement</th>
                                    <th> Type de Demande</th>
                                    <th>Type d'établissement</th>
                                    <th class="text-center">Document</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userRequests as $request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($request->created_at)->isoFormat('DD MMMM YYYY', 'Do MMMM YYYY', 'fr') }}</td>
                                    <td>{{ $request->nom }} {{ $request->prenoms }}</td>
                                    <td>{{ $request->contact}}</td>
                                    <td>{{ $request->email}}</td>
                                    <td>{{ $request->nom}}</td>
                                    <td>{{ $request->requestType->name }}</td>
                                    <td>{{ $request->etablissementType->name }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#documentModal{{ $request->id }}">
                                            <i class="fas fa-file"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="documentModal{{ $request->id }}" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="documentModalLabel">Document de la request</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Vérifiez si la request a un document -->
                                                        @if ($request->document)
                                                        <embed src="{{ asset('storage/' . $request->document->file_path) }}" width="100%" height="500px" frameborder="0">
                                                    @else
                                                        <p>Aucun document associé à cette request.</p>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $request->status }}</td>

                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalDetails{{ $request->id }}">
                                                    <i class="fas fa-info-circle"></i> Détails
                                                </a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $request->id }}">
                                                    <i class="fas fa-edit"></i> Mettre à jour
                                                </a>
                                            </div>
                                        </div>
                                    </td>




                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDemandeModal">Nouvelle demande</button>
                </div>
            </div>
        </div>
    </div>
</div>


 <!-- Modal pour le formulaire de création de request -->
 <div class="modal fade" id="createDemandeModal" tabindex="-1" role="dialog" aria-labelledby="createDemandeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDemandeModalLabel">Formulaire de création de demande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('user.dashboard') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="nomPrenoms">Nom et Prénoms *</label>
                                <input type="text" class="form-control" id="nomPrenoms" name="nomPrenoms" required>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="contact">Contact *</label>
                                <input type="text" class="form-control" id="contact" name="contact" required>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $userEmail }}" required>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="nom">Nom Etablissement *</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="request_type_id">Type de request *</label>
                                <select class="form-control" id="request_type_id" name="request_type_id" required>
                                    @foreach($requestTypes as $requestType)
                                        <option value="{{ $requestType->id }}">{{ $requestType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="etablissement_type_id">Type d'établissement *</label>
                                <select class="form-control" id="etablissement_type_id" name="etablissement_type_id" required>
                                    @foreach($etablissementTypes as $etablissementType)
                                        <option value="{{ $etablissementType->id }}">{{ $etablissementType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="ref_op">Réf. Ordre Pharmacien</label>
                                <input type="text" class="form-control" id="ref_op" name="ref_op">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="ref_diplome">Référence Diplôme</label>
                                <input type="text" class="form-control" id="ref_diplome" name="ref_diplome">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 mb-3">
                                <label for="region_id">Région *</label>
                                <select class="form-control" id="region_id" name="region_id" required>
                                    <option value="" disabled selected>Sélectionner une région</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="prefecture_id">Préfecture *</label>
                                <select class="form-control" id="prefecture_id" name="prefecture_id" required>
                                    <option value="" disabled selected>Sélectionner une préfecture</option>
                                    @foreach($prefectures as $prefecture)
                                        <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="site">Site souhaité</label>
                                <input type="text" class="form-control" id="site" name="site">
                            </div>

                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="etape">Étape *</label>
                                <input type="text" class="form-control" id="etape" name="etape" value="Prétraitement" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="status">Statut *</label>
                                <input type="text" class="form-control" id="status" name="status" value="En attente de traitement" required>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="documents">Documents *</label>
                                <input type="file" class="form-control-file" id="documents" name="documents[]" multiple required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </form>
                </div>

        </div>
    </div>
</div>
<!-- Modale pour les détails de la request -->
@foreach($userRequests as $request)
<div class="modal fade" id="modalDetails{{ $request->id }}" tabindex="-1" aria-labelledby="modalDetailsLabel{{ $request->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailsLabel{{ $request->id }}">Détails de la demande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><b>Date de soumission :</b></td>
                            <td>{{ \Carbon\Carbon::parse($request->created_at)->isoFormat('DD MMMM YYYY', 'Do MMMM YYYY', 'fr') }}</td>
                        </tr>
                        <tr>
                            <td><b>Nom et Prénom :</b></td>
                            <td>{{ $request->nom }} {{ $request->prenoms }}</td>
                        </tr>
                        <tr>
                            <td><b>Téléphone :</b></td>
                            <td>{{ $request->contact }}</td>
                        </tr>
                        <tr>
                            <td><b>Email :</b></td>
                            <td>{{ $request->email }}</td>
                        </tr>
                        <tr>
                            <td><b>Nom de l'Etablissement :</b></td>
                            <td>{{ $request->nom }}</td>
                        </tr>
                        <tr>
                            <td><b>Inscription à L'ordre :</b></td>
                            <td>{{ $request->ref_op }}</td>
                        </tr>
                        <tr>
                            <td><b>Réf. Diplôme :</b></td>
                            <td>{{ $request->ref_diplome }}</td>
                        </tr>
                        <tr>
                            <td><b>Site Souhaite :</b></td>
                            <td>{{ $request->site }}</td>
                        </tr>
                        <tr>
                            <td><b>Type de Demande :</b></td>
                            <td>{{ $request->requestType->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Type d'établissement :</b></td>
                            <td>{{ $request->etablissementType->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Statut :</b></td>
                            <td>{{ $request->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endforeach

<!-- Modale pour la modification de la request -->
@foreach($userRequests as $request)
<div class="modal fade" id="modalEdit{{ $request->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $request->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel{{ $request->id }}">Modifier la demande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire de modification de la request ici -->
                <!-- Exemple : -->
                <form action="{{ route('requests.update', $request->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Ajoutez les champs de modification de la request ici -->
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

