@extends('layouts.app')

@section('content')
<div>
    <h1 class="h3 mt-5 mb-4 text-gray-800">Analyse Flexible des Demandes</h1>
    <div class="row">
        <div class="col-lg-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <!-- Form for flexible analysis -->
                    <form action="{{ route('analysis') }}" method="GET" class="form-inline">
                        <!-- Add your flexible analysis filters here -->
                        <!-- Example: -->
                        <div class="form-group mr-2">
                            <label for="status" class="mr-2">Statut :</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Tous</option>
                                <option value="Reçu">Reçu</option>
                                <option value="En cours">En cours</option>
                                <option value="Approuvé">Approuvé</option>
                                <option value="Rejeté">Rejeté</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="region_id" class="mr-2">Région :</label>
                            <select class="form-control" id="region_id" name="region_id" required>
                                <option value="" disabled selected>Sélectionner une région</option>
                                @foreach($regions as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Filtrer</button>
                    </form>
                </div>

                <div class="card-body">
                    <!-- Display flexible analysis results here -->
                    <!-- Example: -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-header-blue">
                                <tr>
                                    <th>N°</th>
                                    <th>Nom et Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Type de Demande</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop through the analysis results and display them -->
                                <!-- Example: -->
                                @foreach ($flexibleAnalysisResults as $result)
                                    <tr>
                                        <td>{{ $result->id }}</td>
                                        <td>{{ $result->nom }} {{ $result->prenoms }}</td>
                                        <td>{{ $result->contact}}</td>
                                        <td>{{ $result->email}}</td>
                                        <td>{{ $result->requestType->name }}</td>
                                        <td>{{ $result->status }}</td>
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
@endsection
