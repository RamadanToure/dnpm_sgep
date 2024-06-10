<!-- resources/views/admin/prefectures/index.blade.php -->

@extends('layouts.app')

@section('content')
<h1 class="h3 mt-5 mb-4 text-gray-800">Gestion des Préfectures</h1>

<!-- Bouton pour ajouter une nouvelle préfecture -->
<button class="btn btn-success mb-4" data-toggle="modal" data-target="#createPrefectureModal">Ajouter une Préfecture</button>

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-header-blue">
                    <tr>
                        <th>Nom</th>
                        <th>Région</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prefectures as $prefecture)
                    <tr>
                        <td>{{ $prefecture->name }}</td>
                        <td>{{ $prefecture->region->name }}</td>
                        <td>
                            <button class="btn btn-info btn-sm edit-prefecture-btn"
                                    data-id="{{ $prefecture->id }}"
                                    data-name="{{ $prefecture->name }}"
                                    data-region_id="{{ $prefecture->region_id }}"
                                    data-toggle="modal"
                                    data-target="#editPrefectureModal">
                                Éditer
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for creating a new préfecture -->
<div class="modal fade" id="createPrefectureModal" tabindex="-1" role="dialog" aria-labelledby="createPrefectureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPrefectureModalLabel">Ajouter une Préfecture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Formulaire pour créer une nouvelle préfecture -->
            <form action="{{ route('prefectures.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="region_id">Région :</label>
                        <select class="form-control" id="region_id" name="region_id" required>
                            @foreach($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for editing a préfecture -->
<div class="modal fade" id="editPrefectureModal" tabindex="-1" role="dialog" aria-labelledby="editPrefectureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPrefectureModalLabel">Éditer la préfecture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Formulaire pour modifier une préfecture -->
            <form id="editPrefectureForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="region_id">Région :</label>
                        <select class="form-control" id="region_id" name="region_id" required>
                            @foreach($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-prefecture-btn');
        var editForm = document.getElementById('editPrefectureForm');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var name = this.getAttribute('data-name');
                var regionId = this.getAttribute('data-region_id');

                editForm.action = '/prefectures/' + id;
                editForm.querySelector('#name').value = name;
                editForm.querySelector('#region_id').value = regionId;
            });
        });
    });
</script>
@endsection
