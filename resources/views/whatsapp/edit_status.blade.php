@extends('layouts.app')

@section('general-css')
<link rel="stylesheet" href="{{ asset('assets/bundles/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">
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
                            <h4>{{ __('Update WhatsApp Status')}}</h4>
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
                            <form action="{{ route('whatsapp.update')}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Description')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="summernote-simple" name="title" required>{{ $status->description }}</textarea>
                                        <input type="hidden" name="id" value="{{ $status->id }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status Image')}}</label>
                                    <div class="col-sm-12 col-md-4 image-preview">
                                        <div class="chocolat-parent">
                                            <a href="{{ asset('storage/whatsapp_statuses/'.$status->media)}}" class="chocolat-image" title="Just an example">
                                                <div data-crop-image="285">
                                                    <img alt="status_image" src="{{ asset('storage/whatsapp_statuses/'.$status->media) }}" class="img-fluid">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-5">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">{{ __('Choose File')}}</label>
                                            <input type="file" name="image" id="image-upload" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="status">
                                            <option {{ ($status->status) == 1 ? 'selected' : '' }} value="1">Publish</option>
                                            <option {{ ($status->status) == 0 ? 'selected' : '' }} value="2">Pending</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary" type="submit">{{ __('Update Status')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('layouts.footer')
@section('js-libraries')
<script src="{{ asset('assets/bundles/summernote/summernote-bs4.js')}}"></script>
<script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js')}}"></script>
<script src="{{ asset('assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js')}}"></script>
<script src="{{ asset('assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{ asset('assets/bundles/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
<script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/create-post.js')}}"></script>
@endsection
@endsection