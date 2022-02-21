@extends('layouts.app')

@section('general-css')
<link href="{{ asset('assets/bundles/lightgallery/dist/css/lightgallery.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/bundles/ionicons/css/ionicons.min.css')}}">
<link href="{{ asset('assets/bundles/video-js/video-js.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/bundles/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bundles/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">
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
                            <div id="sync1" class="slider owl-carousel owl-theme">
                                @foreach($videos as $key => $rows)
                                <video id="my-video" class="video-js item" controls preload="auto" poster="{{ asset('storage/video_posters/'.$rows->poster)}}" data-setup='' loop>
                                    <source src="{{ asset('storage/videos/'.$rows->video)}}" type='video/mp4'>
                                </video>
                                @endforeach
                            </div>

                            <div id="sync2" class="navigation-thumbs owl-carousel">
                                @foreach($videos as $key => $rows)
                                <div class="item">
                                    <img src="{{ asset('storage/video_posters/'.$rows->poster)}}" class="img-responsive thumbnail" alt="">
                                </div>
                                @endforeach
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
<script src="{{ asset('assets/bundles/video-js/video-js.js')}}"></script>
<script src="{{ asset('assets/bundles/owlcarousel2/dist/owl.carousel.min.js')}}"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/video-audio.js')}}"></script>
@endsection
@endsection