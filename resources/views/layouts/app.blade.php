
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DNPM | SGEP</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <style>
        .table-header-blue {
            background-color: #2575d6; /* Couleur bleu clair */
            color: white; /* Couleur du texte en blanc */
            border-color: #2575d6; /* Couleur de la bordure en bleu clair */
        }

        .card-title {
        font-size: 24px; /* Taille de police agrandie */
        font-weight: bold; /* Texte en gras */
        text-align: center; /* Texte centré */
    }
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="{{ asset('assets/images/dnpm.png') }}" width="50px" height="50px" alt="HR">
                </div>
                <div class="sidebar-brand-text mx-3">DNPM-SGEP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Heading -->
            <div class="sidebar-heading">
               ADMINISTRATION SYSTEME
            </div>

            @if (Auth::check())
                @if (Auth::user()->type_user == 'admin')
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                @else

                   <!-- Nav Item - Mes Demandes -->
                   <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>MES DEMANDES</span>
                    </a>
                </li>

                <!-- Nav Item - ETABLISSEMENTS -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>ETABLISSEMENTS</span>
                    </a>
                    <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('demande.index') }}"><b>Liste des demandes</b></a>
                            <a class="collapse-item" href="{{ route('analysis') }}"> <b>Analyse Flexible</b></a>
                            <a class="collapse-item" href="{{ route('analyse.etapes') }}"> <b>Processus</b></a>
                            <a class="collapse-item" href="#"> <b>Authentification Diplome</b></a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - PARAMETRES -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>PARAMETRES</span>
                    </a>
                    <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('etablissementTypes.index') }}"><b>Type Etablissement</b></a>
                            <a class="collapse-item" href="{{ route('request_types.index') }}"> <b>Type Demandes</b></a>
                            <a class="collapse-item" href="{{ route('regions.index') }}"> <b>Région</b></a>
                            <a class="collapse-item" href="{{ route('prefectures.index') }}"> <b>Préfectures</b></a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilisateurs -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        <span>Utilisateur</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
                @endif



            @endif
        </ul>


        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Auth::check())
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                @endif
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                @if (Auth::check())
                                    @if (Auth::user()->type_user == 'admin')
                                        <p align="center">Administrateur</p>
                                    @elseif (Auth::user()->type_user == 'user')
                                        <p align="center">Utilisateur</p>
                                    @endif
                                @endif


                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Mon compte
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Deconnecter
                                    </button>
                                </form>
                            </div>

                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                @if (Auth::check() && Auth::user()->type_user == 1)
                                    <p>Vous êtes administrateur</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 my-auto">
                                <div class="text-center">
                                    <span>Copyright &copy; Filatech Group</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>

                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->
            @stack('scripts')
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


</body>

</html>
