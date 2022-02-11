@extends('layouts.app')

@section('general-css')
<link rel="stylesheet" href="{{ asset('assets/bundles/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">
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
                            <h4>{{ __('Create Trivia Questions')}}</h4>
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
                            <form action="{{ route('question.create')}}" method="post">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Question')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="summernote-simple" name="question" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Answer')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="answer" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Options')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control inputtags" name="options" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="status">
                                            <option value="1">{{ __('Publish')}}</option>
                                            <option value="2">{{ __('Pending')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary" type="submit">{{ __('Create Question')}}</button>
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
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/create-post.js')}}"></script>
@endsection
@endsection