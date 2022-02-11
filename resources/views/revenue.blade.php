@extends('layouts.app')

@section('content')
@include('layouts.header')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Add revenue')}}</h4>
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
                            <form id="wizard_with_validation" method="POST" action="{{ route('revenue.create')}}">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <label>{{ __('Username')}}</label>
                                        <input type="text" name="username" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Type of Revenue')}}</label>
                                        <select class="custom-select" name="type" required>
                                            <option value="whatsapp" selected>{{ __('WhatsApp Status')}}</option>
                                            <option value="question">{{ __('Trivia Questions')}} </option>
                                            <option value="video">{{ __('Videos')}} </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Amount Earned')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    {{ __('TZS')}}
                                                </div>
                                            </div>
                                            <input type="number" name="amount" id="amount_earned" class="form-control" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">{{ __('Save')}}</button>
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
<script src="{{ asset('assets/bundles/jquery-validation/dist/jquery.validate.min.js')}}"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/transaction.js')}}"></script>
@endsection
@endsection