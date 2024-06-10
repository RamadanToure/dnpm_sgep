@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mes Demandes</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type d'établissement</th>
                <th>Statut</th>
                <th>Étape</th>
                <th>Date de Soumission</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
            <tr>
                <td>{{ $request->id }}</td>
                <td>{{ $request->type_d_etablissement }}</td>
                <td>{{ $request->statut }}</td>
                <td>{{ $request->etape }}</td>
                <td>{{ $request->date_de_soumission }}</td>
                <td>
                    <a href="{{ route('requests.show', $request->id) }}" class="btn btn-info">Voir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
