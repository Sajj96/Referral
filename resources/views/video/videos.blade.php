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
                            <video id="my-video" class="video-js" controls preload="auto" poster="{{ asset('assets/img/image-gallery/thumb/thumb-1.png')}}" data-setup='' loop>
                                <source src="{{ asset('assets/videos/sintel-short.mp4')}}" type='video/mp4'>
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
                            <h4>Video</h4>
                        </div>
                        <div class="card-body">
                            <div id="aniimated-videos" class="list-unstyled row clearfix">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a data-src='{"source": [{"src": "{{ asset("assets/videos/sintel-short.mp4")}}", "type": "video/mp4"}], "attributes": {"preload": false, "controls": true}}' data-poster="assets/img/image-gallery/thumb/thumb-2.png" data-sub-html="Demo Description" class="lg-html5">
                                        <img class="img-responsive thumbnail" src="assets/img/image-gallery/thumb/thumb-2.png" alt="">
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a data-pinterest-text="Pin it3" data-tweet-text="lightGallery slide  4" data-src='{"source": [{"src":"assets/videos/sintel-short.mp4", "type":"video/mp4"}], "tracks": [{"src": "https://www.lightgalleryjs.com/videos/title.txt", "kind":"captions", "srclang": "en", "label": "English", "default": "true"}], "attributes": {"preload": false, "controls": true}}' data-poster="assets/img/image-gallery/thumb/thumb-4.png" data-sub-html="<h4>'Peck Pocketed' by Kevin Herron | Disney Favorite</h4>">
                                        <img class="img-responsive" src="assets/img/image-gallery/thumb/thumb-4.png" />
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a href="assets/img/image-gallery/thumb/thumb-2.png" data-sub-html="Demo Description">
                                        <img class="img-responsive thumbnail" src="assets/img/image-gallery/thumb/thumb-3.png" alt="">
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
<script src="{{ asset('assets/js/page/video-audio.js')}}"></script>
@endsection
@endsection