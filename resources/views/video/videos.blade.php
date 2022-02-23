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
    <section class="section" data-user="{{ $user->id }}">
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
                                @foreach($video_users as $key => $values)
                                @if($rows->id != $values->video_id && $rows->user_id != $values->user_id)
                                <video id="{{ 'video_'.$rows->id }}" data-id="{{ $rows->id }}" class="video-js item videos" controls preload="auto" poster="{{ asset('storage/video_posters/'.$rows->poster)}}" data-setup=''>
                                    <source src="{{ asset('storage/videos/'.$rows->video)}}" type='video/mp4'>
                                </video>
                                @endif
                                @endforeach
                                @endforeach
                            </div>

                            <div id="sync2" class="navigation-thumbs owl-carousel">
                                @foreach($videos as $key => $rows)
                                @foreach($video_users as $key => $values)
                                @if($rows->id != $values->video_id && $rows->user_id != $values->user_id)
                                <div class="item">
                                    <img src="{{ asset('storage/video_posters/'.$rows->poster)}}" class="img-responsive thumbnail" alt="">
                                </div>
                                @endif
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h2>Congrats! 🎉</h2>
                    <h4>You got <strong>TZS 250 </strong> for watching this video</h4>
                </div>
            </div>
        </div>
    </div>
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