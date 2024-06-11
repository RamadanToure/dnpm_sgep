@extends('layouts.app')

@section('content')
<div>
    <h1 class="h3 mt-5 mb-4 text-gray-800">Gestion des Demandes</h1>
    <div class="row">
        <div class="col-lg-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <form action="{{ route('demande.index') }}" method="GET" class="form-inline">
                        <div class="form-group mr-2">
                            <label for="type_demande" class="mr-2">Type de demande :</label>
                            <select class="form-control" id="type_demande" name="type_demande">
                                <option value="">Tous</option>
                                @foreach($requestTypes as $requestType)
                                    <option value="{{ $requestType->id }}">{{ $requestType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mr-2">
                            <label for="type_etablissement" class="mr-2">Type d'établissement :</label>
                            <select class="form-control" id="type_etablissement" name="type_etablissement">
                                <option value="">Tous</option>
                                @foreach($etablissementTypes as $etablissementType)
                                    <option value="{{ $etablissementType->id }}">{{ $etablissementType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mr-2">
                            <label for="statut" class="mr-2">Statut :</label>
                            <select class="form-control" id="statut" name="statut">
                                <option value="">Tous</option>
                                <option value="Reçu">Reçu</option>
                                <option value="En cours">En cours</option>
                                <option value="Approuvé">Approuvé</option>
                                <option value="Rejeté">Rejeté</option>
                            </select>
                        </div>

                        <div class="form-group mr-2">
                            <label for="search" class="mr-2">Recherche :</label>
                            <input type="text" class="form-control" id="search" name="search" placeholder="Nom ou prénom">
                        </div>

                        <div class="form-group mr-2">
                            <label for="telephone" class="mr-2">Téléphone :</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Numéro de téléphone">
                        </div>

                        <div class="form-group mr-2">
                            <button type="submit" class="btn btn-primary mr-2">Filtrer</button>

                        </div>
                    </form>


                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createDemandeModal">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Nouvelle demande
                        </button>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">

                        <form action="{{ route('demande.bulkAction') }}" method="POST">
                            @csrf
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
                                        {{-- <th>Inscription à L'ordre</th>
                                        <th>Réf. Diplôme</th> --}}
                                        <th>Site Souhaite</th>
                                        <th> Type de Demande</th>
                                        <th>Type d'établissement</th>
                                        <th class="text-center">Statut</th>
                                        <th class="text-center">Document</th>
                                        <th class="text-center"><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($demandes as $demande)
                                        <tr>
                                            <td><input type="checkbox" name="selected[]" value="{{ $demande->id }}"></td>
                                            <td>{{ $demande->id }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($demande->created_at)->isoFormat('DD MMMM YYYY', 'Do MMMM YYYY', 'fr') }}</td>
                                            <td>{{ $demande->nom }} {{ $demande->prenoms }}</td>
                                            <td>{{ $demande->contact}}</td>
                                            <td>{{ $demande->email}}</td>
                                            <td>{{ $demande->nom}}</td>
                                            {{-- <td>{{ $demande->ref_op}}</td>
                                            <td>{{ $demande->ref_diplome}}</td> --}}
                                            <td>{{ $demande->site}}</td>
                                            <td>{{ $demande->requestType->name }}</td>
                                            <td>{{ $demande->etablissementType->name }}</td>
                                            <td class="text-center">{{ $demande->status }}</td>

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
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <a class="btn btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="{{ route('demande.show', $demande->id) }}">
                                                            <i class="fas fa-eye"></i> Voir
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('demande.edit', $demande->id) }}">
                                                            <i class="fas fa-edit"></i> Modifier
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" align="center">
                                                <h6>AUCUNE DEMANDE TROUVÉE</h6>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Modal pour le formulaire de création de demande -->
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
                                            <form method="GET" action="{{ route('demande.submit') }}" enctype="multipart/form-data">
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
                                                        <input type="email" class="form-control" id="email" name="email" required>
                                                    </div>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="nom">Nom de l'établissement *</label>
                                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="request_type_id">Type de demande *</label>
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

                        {{-- Pagination --}}
                        <div class="d-flex justify-content-center mt-3">
                            {{ $demandes->links() }}
                        </div>

</div>


<script>
    document.getElementById('select-all').addEventListener('click', function(event) {
        const checkboxes = document.querySelectorAll('input[name="selected[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });
</script>
@endsection
