@extends('layouts.app')

@section('general-css')
@endsection

@section('content')
@include('layouts.header')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('WhatsApp Status')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="bootstrap snippet">
                                <section id="portfolio" class="gray-bg padding-top-bottom">
                                    <!-- ======= Portfolio items ===-->
                                    <div class="projects-container scrollimation in">
                                        <div class="row">
                                            <article class="col-md-4 col-sm-6 portfolio-item web-design apps psd">
                                                <div class="portfolio-thumb in">
                                                    <a href="#" class="main-link">
                                                        <img class="img-responsive img-center" src="assets/img/image-gallery/thumb/thumb-3.png" alt="">
                                                        <span class="project-title">Title 1</span>
                                                        <span class="overlay-mask"></span>
                                                    </a>
                                                    <a class="enlarge cboxElement" href="#" title="Bills Project"><i class="fas fa-share-alt fa-fw"></i></a>
                                                    <a class="link" href="#"><i class="fas fa-download fa-fw"></i></a>
                                                </div>
                                            </article>
                                            <article class="col-md-4 col-sm-6 portfolio-item apps">
                                                <div class="portfolio-thumb in">
                                                    <a href="#" class="main-link">
                                                        <img class="img-responsive img-center" src="assets/img/image-gallery/thumb/thumb-2.png" alt="">
                                                        <span class="project-title">Title 2</span>
                                                        <span class="overlay-mask"></span>
                                                    </a>
                                                    <a class="link centered" href="#"><i class="fa fa-eye fa-fw"></i></a>
                                                </div>
                                            </article>
                                            <article class="col-md-4 col-sm-6 portfolio-item web-design psd">
                                                <div class="portfolio-thumb in">
                                                    <a href="#" class="main-link">
                                                        <img class="img-responsive img-center" src="assets/img/image-gallery/thumb/thumb-1.png" alt="">
                                                        <span class="project-title">Title 3</span>
                                                        <span class="overlay-mask"></span>
                                                    </a>
                                                    <a class="enlarge centered cboxElement" href="#" title="Get Colored"><i class="fa fa-expand fa-fw"></i></a>
                                                </div>
                                            </article>
                                            <article class="col-md-4 col-sm-6 portfolio-item apps">
                                                <div class="portfolio-thumb in">
                                                    <a href="#" class="main-link">
                                                        <img class="img-responsive img-center" src="assets/img/image-gallery/thumb/thumb-4.png" alt="">
                                                        <span class="project-title">Title 4</span>
                                                        <span class="overlay-mask"></span>
                                                    </a>
                                                    <a class="enlarge cboxElement" href="#" title="Holiday Selector"><i class="fa fa-expand fa-fw"></i></a>
                                                    <a class="link" href="#"><i class="fa fa-eye fa-fw"></i></a>
                                                </div>
                                            </article>
                                            <article class="col-md-4 col-sm-6 portfolio-item web-design psd">
                                                <div class="portfolio-thumb in">
                                                    <a href="#" class="main-link">
                                                        <img class="img-responsive img-center" src="assets/img/image-gallery/thumb/thumb-5.png" alt="">
                                                        <span class="project-title">Title 5</span>
                                                        <span class="overlay-mask"></span>
                                                    </a>
                                                    <a class="enlarge cboxElement" href="#" title="Scavenger Hunt"><i class="fa fa-expand fa-fw"></i></a>
                                                    <a class="link" href="#"><i class="fa fa-eye fa-fw"></i></a>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('layouts.footer')
@section('js-libraries')
<script src="{{ asset('assets/js/page/portfolio.js')}}"></script>
@endsection
@endsection