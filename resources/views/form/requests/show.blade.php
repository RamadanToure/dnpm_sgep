@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails de la Demande #{{ $request->id }}</h2>
    <p><strong>Type d'établissement :</strong> {{ $request->type_d_etablissement }}</p>
    <p><strong>Statut :</strong> {{ $request->statut }}</p>
    <p><strong>Étape :</strong> {{ $request->etape }}</p>
    <p><strong>Date de Soumission :</strong> {{ $request->date_de_soumission }}</p>
    <h4>Documents</h4>
    <ul>
        @foreach ($request->documents as $document)
        <li>
            <a href="{{ Storage::url($document->fichier) }}" target="_blank">{{ $document->type_document }}</a>
        </li>
        @endforeach
    </ul>
</div>
@endsection
