{{-- @extends('layouts.app')

@section('content')
    <div>
        <h1 class="h3 mt-5 mb-4 text-gray-800">Formulaire de création de demande</h1>

        <div class="row">
            <div class="col-lg-12">

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tous les champs marqués d'un * sont obligatoires</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('demande.submit') }}" enctype="multipart/form-data">
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
                                    <label for="prefecture_ide">Préfecture *</label>
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
    </div>
@endsection --}}

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
                <form method="POST" action="{{ route('demande.submit') }}" enctype="multipart/form-data">
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
