@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
<!-- Nombre de transferts Card -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nombre de Demandes:</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nombreDeTransferts }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Demandes de création Card -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Transferts :</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDemandesCreation }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Officines en exploitation Card -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Officines en exploitation :</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $etablissementsParRegion['Officines en exploitation'] ?? 0 }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Another Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Autre Information :</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anotherData ?? 0 }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-fw fa-info-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>

    <!-- Section Graphiques -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Établissements par Catégorie</h6>
                </div>
                <div class="card-body">
                    <canvas id="etablissementsParCategorie"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Établissements par Région</h6>
                </div>
                <div class="card-body">
                    <canvas id="etablissementsParRegion"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Section des Demandes -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mes Demandes</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Statut</th>
                                    <th>Date de Création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userRequests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->type }}</td>
                                    <td>{{ $request->statut }}</td>
                                    <td>{{ $request->created_at }}</td>
                                    <td>
                                        <a href="{{ route('requests.show', $request->id) }}" class="btn btn-info btn-sm">Voir</a>
                                        <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-warning btn-sm">Modifier</a>
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
<!-- Section Profil -->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mon Profil</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Nouveau Mot de Passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="form-text text-muted">Laissez vide si vous ne souhaitez pas changer votre mot de passe.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx1 = document.getElementById('etablissementsParCategorie').getContext('2d');
    var chart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($etablissementsParCategorie)) !!},
            datasets: [{
                label: 'Nombre d\'établissements par catégorie',
                data: {!! json_encode(array_values($etablissementsParCategorie)) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctx2 = document.getElementById('etablissementsParRegion').getContext('2d');
    var chart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($etablissementsParRegion)) !!},
            datasets: [{
                label: 'Nombre d\'établissements par région',
                data: {!! json_encode(array_values($etablissementsParRegion)) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
