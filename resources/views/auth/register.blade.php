<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inscription</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    {{-- <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
    <style>
        .bg-login-image {
            background-image: url("path_to_your_image.jpg");
            background-size: cover;
        }

    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <hr>
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card">
                    <div class="card-header text-center">{{ __('FORMULAIRE D\'INSCRIPTION') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-none d-lg-block bg-login-image" style="background-image: url('{{ asset('images/seg-1.jpg') }}');"></div>

                            <div class="col-md-6">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">{{ __('Nom complet') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" required autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">{{ __('Adresse email') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">{{ __('Mot de passe') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirmer mot de passe') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                            required>
                                    </div>

                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                        @if (Route::has('login'))
                                            <p class="text-center mt-2">Vous avez déjà un compte ? <a
                                                    href="{{ route('login') }}">Connectez-vous</a></p>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
