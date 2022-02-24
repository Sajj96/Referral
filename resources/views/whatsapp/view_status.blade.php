@extends('layouts.app')

@section('general-css')
<link href="{{ asset('assets/bundles/lightgallery/dist/css/lightgallery.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/css/lg-share.min.css" integrity="sha512-dOqsuo1HGMv5ohBl/0OIUVzkwFLF8ZmjhpZp2VT2mpH5UuOJXwtBhxxtbrrEIpvTDWm7mESg0JsEl4zkUGv/gw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
@include('layouts.header')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('WhatsApp Status - Share with friends and Earn.')}}</h4>
                        </div>
                        <div class="card-body">
                        <p>In order to earn, your status must reach atleat 30 viewers. Take screenshot of the status showing the number of viewers and upload it.</p>
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                @if(count($whatsapp_status) > 0)
                                @foreach($whatsapp_status as $key=>$rows)
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a data-src="{{ asset('storage/whatsapp_statuses/'.$rows->media)}}" 
                                        data-sub-html='<h3>{{ $rows->description }}</h3><a href="https://api.whatsapp.com/send?text={{ asset("storage/whatsapp_statuses/".$rows->media)}}%20{{ asset("storage/whatsapp_statuses/".$rows->media)}}" data-action="share/whatsapp/share" class="btn btn-md btn-success col-grren" target="_blank">
                                        <img src="{{ asset("assets/img/whatsappicon.png")}}"/>
                                        <span class="lg-dropdown-text">Share on WhatsApp</span>'
                                        data-lg-size="1400-1400"
                                    >
                                        <img class="img-responsive thumbnail" src="{{ asset('storage/whatsapp_statuses/'.$rows->media)}}" alt="">
                                    </a>
                                </div>
                                @endforeach
                                @else
                                <h4>There is no status currently.</h4>
                                @endif
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
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/light-gallery.js')}}"></script>
@endsection
@endsection