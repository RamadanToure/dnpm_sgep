@extends('layouts.app')

@section('content')
<h1 class="h3 mt-5 mb-4 text-gray-800">Analyse des Étapes de la Procédure</h1>

<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-header-blue">
                        <tr>
                            <th scope="col">Étape</th>
                            <th scope="col">Durée moyenne (jours)</th>
                            <th scope="col">Statut actuel</th>
                            <th scope="col">Étapes en retard (jours)</th>
                            <th scope="col">Taux de réussite (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dureesMoyennes as $etape => $duree)
                            <tr>
                                <td>{{ $etape }}</td>
                                <td>{{ $duree }}</td>
                                <td>{{ isset($statuts[$etape]) ? $statuts[$etape] : 'Non défini' }}</td>
                                <td>{{ isset($retards[$etape]) ? $retards[$etape] : 'Non défini' }}</td>
                                <td>
                                    @if (!is_string($duree))
                                        @php
                                            $tauxReussite = ($duree / $nombreTotalEtapes) * 100;
                                        @endphp
                                        {{ $tauxReussite }}%
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
