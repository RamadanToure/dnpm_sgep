@extends('layouts.app')

@section('content')
<div class="card-body">
    <h1 class="h3 mt-5 mb-4 text-gray-800">Liste des Types d'établissement</h1>
    <div class="mb-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">Ajouter un Type d'établissement</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($etablissementTypes as $etablissementType)
                <tr>
                    <td>{{ $etablissementType->name }}</td>
                    <td class="text-center">
                        <!-- Bouton Modifier -->
                        <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editModal" data-id="{{ $etablissementType->id }}">
                            <i class="fas fa-edit"></i> <!-- Utilisation de l'icône d'édition de Font Awesome -->
                        </button>
                        <!-- Bouton Supprimer -->
                        <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal" data-url="{{ route('etablissementTypes.destroy', $etablissementType->id) }}">
                            <i class="fas fa-trash"></i> <!-- Utilisation de l'icône de suppression de Font Awesome -->
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Créer un Type d'établissement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Include your create form here -->
                <form action="{{ route('etablissementTypes.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier un Type d'établissement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Include your edit form here -->
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="edit_name">Nom :</label>
                        <input type="text" class="form-control" id="edit_name" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Handler for edit button click
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var url = "{{ route('etablissementTypes.edit', ':id') }}".replace(':id', id);
        $('#editForm').attr('action', url);
        $('#editModal').modal('show');
    });

    // Handler for delete button click
    $(document).on('click', '.delete-btn', function() {
        var url = $(this).data('url');
        $('#deleteForm').attr('action', url);
        $('#deleteModal').modal('show');
    });
</script>
@endpush
