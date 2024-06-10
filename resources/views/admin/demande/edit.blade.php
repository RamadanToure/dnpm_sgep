@extends('layouts.app')

@section('content')
    <h1 class="h3 mt-5 mb-4 text-gray-800">Modifier la demande</h1>
    <div class="row">
        <div class="col-lg-12">
            <!-- Basic Card Example -->
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
                    <form method="POST" action="{{ route('', $demande->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- <div class="form-group row">
                            <div class="col-sm-6 mb-6 mb-sm-0">
                                <label for="nom" class="col-sm-2 col-form-label">Nom *</label>
                                <input id="nom" name="nom" type="text" class="form-control" placeholder="Nom *" required value="{{ $demande->nom }}">
                            </div>
                            <div class="col-sm-6 mb-6 mb-sm-0">
                                <label for="nomPrenoms" class="col-sm-2 col-form-label">Nom et Prénoms *</label>
                                <input id="nomPrenoms" name="nomPrenoms" type="text" class="form-control" placeholder="Nom et Prénoms *" required value="{{ $demande->nomPrenoms }}">
                            </div>

                            <div class="col-sm-6 mb-6 mb-sm-0">
                                <label for="contact" class="col-sm-2 col-form-label">Contact *</label>
                                <input id="contact" name="contact" type="text" class="form-control" placeholder="Contact *" required value="{{ $demande->contact }}">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="email" class="col-sm-2 col-form-label">Email *</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email *" required value="{{ $demande->email }}">
                            </div>

                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="type_etablissement" class="col-sm-2 col-form-label">Type d'établissement *</label>
                                <input id="type_etablissement" name="type_etablissement" type="text" class="form-control" placeholder="Type d'établissement *" required value="{{ $demande->type_etablissement }}">
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="statut" class="col-sm-2 col-form-label">Statut *</label>
                                <input id="statut" name="statut" type="text" class="form-control" placeholder="Statut *" required value="{{ $demande->statut }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="etape" class="col-sm-2 col-form-label">Étape *</label>
                                <input id="etape" name="etape" type="text" class="form-control" placeholder="Étape *" required value="{{ $demande->etape }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="region" class="col-sm-2 col-form-label">Région *</label>
                                <input id="region" name="region" type="text" class="form-control" placeholder="Région *" required value="{{ $demande->region }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="prefecture" class="col-sm-2 col-form-label">Préfecture *</label>
                                <input id="prefecture" name="prefecture" type="text" class="form-control" placeholder="Préfecture *" required value="{{ $demande->prefecture }}">
                            </div>
                        </div> --}}
                        <!-- Ajoutez d'autres champs de formulaire selon vos besoins -->
                        {{-- <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="document" class="col-sm-2 col-form-label">Document</label>
                                <input id="document" name="document" type="file" class="form-control-file">
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-sm-6">
                                <label for="description" class="col-sm-2 col-form-label">Description *</label>
                                <textarea id="description" name="description" class="form-control" placeholder="Description *" required>{{ $demande->description }}</textarea>
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="nomPrenoms">Nom et Prénoms *</label>
                                <input type="text" class="form-control" id="nomPrenoms" name="nomPrenoms" required value="{{ $demande->nomPrenoms }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="contact">Contact *</label>
                                <input type="text" class="form-control" id="contact" name="contact" required value="{{ $demande->contact }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required value="{{ $demande->email }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="nom">Nom de l'établissement *</label>
                                <input type="text" class="form-control" id="nom" name="nom" required value="{{ $demande->nom }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="type_etablissement">Type d'établissement *</label>
                                <select class="form-control" id="type_etablissement" name="type_etablissement" required >
                                    <option value="Officine Privée">Officine Privée</option>
                                    <option value="Point de vente">Point de vente</option>
                                    <option value="Grossiste répartiteur">Grossiste répartiteur</option>
                                    <option value="Industrie pharmaceutique">Industrie pharmaceutique</option>
                                </select>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="region">Région *</label>
                                <input type="text" class="form-control" id="region" name="region" required value="{{ $demande->region }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="prefecture">Préfecture *</label>
                                <input type="text" class="form-control" id="prefecture" name="prefecture" required value="{{ $demande->prefecture }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="documents">Documents *</label>
                                <input type="file" class="form-control-file" id="documents" name="documents[]" multiple required value="{{ $demande->documents }}">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-user"><i class="fa fa-save"></i> Modifier</button>
                            <a class="btn btn-danger btn-user" href="{{ route('demande.index') }}"><i class="fa fa-times-circle"></i> Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
