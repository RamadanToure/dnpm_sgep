@extends('layouts.app')

@section('content')
    <h1 class="h3 mt-5 mb-4 text-gray-800">Modifier l'utilisateur</h1>
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
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nom d'utilisateur *</label>
                            <div class="col-sm-6">
                                <input id="name" name="name" type="text" class="form-control" placeholder="Nom d'utilisateur *" required value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email *</label>
                            <div class="col-sm-6">
                                <input id="email" name="email" type="email" class="form-control" placeholder="email *" required value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-2 col-form-label">Type d'utilisateur</label>
                            <div class="col-sm-6">
                                <select id="role" name="role" class="form-control" required>
                                    @if ($user->type_user == 1)
                                        <option value="1" selected>Administrateur</option>
                                        <option value="0">Sous administrateur</option>
                                    @else
                                        <option value="1">Administrateur</option>
                                        <option value="0" selected>Sous administrateur</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-user"><i class="fa fa-save"></i> Modifier</button>
                            <a class="btn btn-danger btn-user" href="{{ route('users.index') }}"><i class="fa fa-times-circle"></i> Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
