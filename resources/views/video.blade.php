@extends('layouts.app')

@section('general-css')
<link href="{{ asset('assets/bundles/lightgallery/dist/css/lightgallery.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/bundles/ionicons/css/ionicons.min.css')}}">
<link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />
@endsection

@section('content')
@include('layouts.header')
<div class="main-content">
    <section class="section" data-user="{{ $user->username }}">
        <div class="section-body">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Video</h4>
                        </div>
                        <div class="card-body">
                            <video id="my-video" class="video-js" controls preload="auto" poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg" data-setup='' loop>
                                <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4" type='video/mp4'>
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="section-body">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ads Gallery</h4>
                        </div>
                        <div class="card-body">
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a href="https://www.youtube.com/embed/xFa2_PVMeDQ?rel=0&autoplay=1" data-sub-html="Demo Description">
                                        <img class="img-responsive thumbnail" src="assets/img/image-gallery/thumb/thumb-2.png" alt="">
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a href="https://www.youtube.com/embed/hSrOpTYKNMw?rel=0&autoplay=1" data-sub-html="Demo Description">
                                        <img class="img-responsive thumbnail" src="assets/img/image-gallery/thumb/thumb-3.png" alt="">
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a href="assets/img/image-gallery/4.png" data-sub-html="Demo Description">
                                        <img class="img-responsive thumbnail" src="assets/img/image-gallery/thumb/thumb-4.png" alt="">
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a href="assets/img/image-gallery/5.png" data-sub-html="Demo Description">
                                        <img class="img-responsive thumbnail" src="assets/img/image-gallery/thumb/thumb-5.png" alt="">
                                    </a>
                                </div>
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
<script src="{{ asset('assets/bundles/lightgallery/dist/js/lightgallery-all.js')}}"></script>
<script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/light-gallery.js')}}"></script>
<script src="{{ asset('assets/js/page/video-audio.js')}}"></script>
@endsection
@endsection