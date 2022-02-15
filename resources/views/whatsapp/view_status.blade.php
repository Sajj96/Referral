@extends('layouts.app')

@section('general-css')
<link href="{{ asset('assets/bundles/lightgallery/dist/css/lightgallery.css')}}" rel="stylesheet">
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
                            <h4>{{ __('WhatsApp Status')}}</h4>
                        </div>
                        <div class="card-body">
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                @if(count($whatsapp_status) > 0)
                                @foreach($whatsapp_status as $key=>$rows)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <a href="{{ asset('storage/whatsapp_statuses/'.$rows->media)}}" data-sub-html="Demo Description">
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
<script src="{{{ asset('assets/js/page/light-gallery.js')}}}"></script>
@endsection
@endsection