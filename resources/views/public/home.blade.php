@extends('layouts.public')

@section('content')
<section class="hero-section hero-section-full-height">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-12 p-0">
                <div id="hero-slide" class="carousel carousel-fade slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/images/slide/officine.jpg') }}"
                                class="carousel-image img-fluid" alt="...">

                            <div class="carousel-caption d-flex flex-column justify-content-end">
                                <h1>OFFICINE</h1>

                                <p>Votre demande de création en ligne</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/slide/exploitation.jpg') }}"
                                class="carousel-image img-fluid" alt="...">

                            <div class="carousel-caption d-flex flex-column justify-content-end">
                                <h1>EXPLOITATION</h1>

                                <p>Votre demande d exploitation en ligne</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/slide/transfert.jpg') }}"
                                class="carousel-image img-fluid" alt="...">

                            <div class="carousel-caption d-flex flex-column justify-content-end">
                                <h1>TRANSFERT</h1>

                                <p>Votre demande de transfert en ligne</p>
                            </div>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#hero-slide"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#hero-slide"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-10 col-12 text-center mx-auto">
                <h2 class="mb-5">BIENVENU SUR DNPM SGEP</h2>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="{{ route('officine') }}" class="d-block">
                        <img src="images/icons/hands.png" class="featured-block-image img-fluid" alt="">

                        <p class="featured-block-text">Officine <strong>Privé</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="{{ route('industrie') }}" class="d-block">
                        <img src="images/icons/heart.png" class="featured-block-image img-fluid" alt="">

                        <p class="featured-block-text"><strong>Industries</strong> Pharmaceutique</p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="{{ route('grossiste') }}" class="d-block">
                        <img src="images/icons/receive.png" class="featured-block-image img-fluid" alt="">

                        <p class="featured-block-text">Grossiste<strong> Répartiteur</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="{{ route('agence') }}" class="d-block">
                        <img src="images/icons/scholarship.png" class="featured-block-image img-fluid" alt="">

                        <p class="featured-block-text"><strong>Agence de </strong>Promotion</p>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="section-padding section-bg" id="section_2">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                <img src="{{ asset('assets/images/dn.png') }}"
                    class="custom-text-box-image img-fluid" alt="">
            </div>

            <div class="col-lg-6 col-12">
                <div class="custom-text-box">
                    <h2 class="mb-2">NOTE HISTOIRE</h2>

                    <h5 class="mb-3">Direction Nationale de Pharmacie et du Médicament</h5>

                    <p class="mb-0">Le Directeur anime, coordonne, supervise et évalue les activités de la Direction.

                        Le Directeur national est assisté d’un Directeur National Adjoint nommé dans les mêmes conditions que lui, qui le remplace en cas d’absence ou d’empêchement.

                        Il est particulièrement chargé :

                          D’assister le Directeur National dans les domaines de la coordination et du contrôle des activités ;
                          D’assurer la coordination technique des activités ;
                          De superviser l’élaboration des projets, programmes et rapports d’activités de la Direction ;
                          D’exécuter toutes autres tâches qui lui sont confiées par le Directeur National.</p>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="custom-text-box mb-lg-0">
                            <h5 class="mb-3">NOTRE MISSION</h5>

                            <p>Elle est chargée de la coordination des actions des différentes sections de son domain</p>

                            <ul class="custom-list mt-2">
                                <li class="custom-list-item d-flex">
                                    <i class="bi-check custom-text-box-icon me-2"></i>
                                    Homologation et Importation
                                </li>

                                <li class="custom-list-item d-flex">
                                    <i class="bi-check custom-text-box-icon me-2"></i>
                                    Economie du Médicament
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="custom-text-box d-flex flex-wrap d-lg-block mb-lg-0">
                            <div class="counter-thumb">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="2009"
                                        data-speed="1000"></span>
                                    <span class="counter-number-text"></span>
                                </div>

                                <span class="counter-text">Fondée</span>
                            </div>

                            <div class="counter-thumb mt-4">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="120"
                                        data-speed="1000"></span>
                                    <span class="counter-number-text">B</span>
                                </div>

                                <span class="counter-text">Donations</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="about-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-5 col-12">
                <img src="{{ asset('assets/images/portrait-volunteer-who-organized-donations-charity.jpg') }}"
                    class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="">
            </div>

            <div class="col-lg-5 col-md-7 col-12">
                <div class="custom-text-block">
                    <h2 class="mb-0">Dr. Mamadi Mariama CAMARA</h2>

                    <p class="text-muted mb-lg-4 mb-md-4">Founding Partner</p>

                    <p>La Direction Nationale de la Pharmacie et du Médicament est dirigée par un Directeur national et Adjoint </p>


                    <ul class="social-icon mt-4">
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-twitter"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-facebook"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-instagram"></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>




@endsection
