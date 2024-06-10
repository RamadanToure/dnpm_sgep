@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Soumettre une nouvelle demande</h2>
    <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="type_d_etablissement">Type d'établissement</label>
            <input type="text" class="form-control" id="type_d_etablissement" name="type_d_etablissement" required>
        </div>
        <div class="form-group">
            <label for="documents">Documents</label>
            <input type="file" class="form-control-file" id="documents" name="documents[]" multiple required>
        </div>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>
@endsection
