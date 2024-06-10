@extends('layouts.app')

@section('content')
<div>
    <h1 class="h3 mt-5 mb-4 text-gray-800">Gestion des Demandes</h1>

    <!-- Bouton pour la création -->
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#createDemandeModal">Créer une nouvelle demande</button>

    <!-- Tableau -->
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th> <!-- Ajouté d'autres en-têtes au besoin -->
                </tr>
            </thead>
            <tbody>
                <!-- Boucle pour afficher les demandes -->
                @foreach ($regions as $region)
                <tr>
                    <td>{{ $region->id }}</td>
                    <td>{{ $region->name }}</td>
                    <td>{{ $region->description }}</td> <!-- Ajouté la colonne Description -->
                    <td>
                        <a href="{{ route('regions.edit', $region->id) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('regions.destroy', $region->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette région ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for creating a new demande -->
<div class="modal fade" id="createDemandeModal" tabindex="-1" role="dialog" aria-labelledby="createDemandeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDemandeModalLabel">Créer une nouvelle demande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Formulaire pour créer une nouvelle demande -->
            <form action="{{ route('regions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="name" required>
                    </div>

                    <!-- Ajoutez d'autres champs au besoin -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for editing a demande -->
<div class="modal fade" id="editDemandeModal" tabindex="-1" role="dialog" aria-labelledby="editDemandeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDemandeModalLabel">Éditer la demande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Formulaire pour modifier une demande -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="name"  required>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Code JavaScript pour gérer l'ouverture et la fermeture des modales
    document.addEventListener('DOMContentLoaded', function() {
        // Ouvrir la modal de création de demande lorsque le bouton "Nouvelle demande" est cliqué
        document.querySelector('.btn-new-demande').addEventListener('click', function() {
            $('#createDemandeModal').modal('show');
        });

        // Ouvrir la modal de modification de demande lorsque le bouton "Modifier" est cliqué
        document.querySelectorAll('.btn-edit-demande').forEach(function(button) {
            button.addEventListener('click', function() {
                // Récupérer l'ID de la demande à partir de l'attribut data du bouton
                let demandeId = this.dataset.demandeId;
                // Peupler la modal de modification de demande avec les données de la demande sélectionnée
                // Vous pouvez utiliser AJAX pour récupérer les données de la demande et peupler la modal ici
                // Pour simplifier, je me contente d'afficher l'ID de la demande pour l'instant
                console.log('Modification de la demande avec l\'ID : ' + demandeId);
                $('#editDemandeModal').modal('show');
            });
        });
    });
</script>
@endsection
