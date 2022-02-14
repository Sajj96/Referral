@extends('layouts.app')

@section('general-css')
<link rel="stylesheet" href="{{ asset('assets/bundles/chocolat/dist/css/chocolat.css')}}">
@endsection

@section('content')
@include('layouts.header')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('WhatsApp Screenshot Details')}}</h4>
                        </div>
                        @include('flash-message')
                        <div class="card-body">
                            @if(count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    @foreach ($errors->all() as $error)
                                    {{ $error }}
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @if(\Session::has('message'))
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    {{ \Session::get('message')}}
                                </div>
                            </div>
                            @endif
                            @if(request()->session()->has('danger'))
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    {{request()->session()->pull('danger')}}
                                </div>
                            </div>
                            @endif
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Posted By')}}</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" value="{{ $screenshot->name }}" name="options" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Screenshot')}}</label>
                                <div class="col-sm-12 col-md-4 image-preview">
                                    <div class="chocolat-parent">
                                        <a href="{{ asset('storage/screenshots/'.$screenshot->screenshot)}}" class="chocolat-image" title="Just an example">
                                            <div data-crop-image="285">
                                                <img alt="screenshot_image" src="{{ asset('storage/screenshots/'.$screenshot->screenshot) }}" class="img-fluid">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @if($screenshot->status == 0)
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="buttons">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">{{ __('Approve')}}</button>
                                        <button class="btn btn-danger">{{ __('Reject')}}</button>
                                    </div>
                                </div>
                            </div>
                            @endif
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
                    <h5 class="modal-title" id="formModal">Make payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="" method="post" action="{{ route('revenue.create') }}">
                        @csrf
                        <div class="form-group">
                            <label>Amount Earned</label>
                            <input type="hidden" class="form-control" value="{{ $screenshot->user_id }}" name="user_id">
                            <input type="hidden" class="form-control" value="whatsapp" name="type">
                            <input type="hidden" class="form-control" value="{{ $screenshot->id }}" name="id">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        TZS
                                    </div>
                                </div>
                                <input type="number" class="form-control" placeholder="Amount" name="amount">
                            </div>
                        </div>
                </div>
                <button type="submit" class="btn btn-primary m-t-15 waves-effect">PAY</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@include('layouts.footer')
@section('js-libraries')
<script src="{{ asset('assets/bundles/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
<script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
@endsection
@endsection