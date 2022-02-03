@extends('layouts.app')

@section('general-css')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
@include('layouts.header')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Withdrawal details')}}</h4>
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
                            <form id="wizard_with_validation" method="POST" action="{{ route('payment')}}">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <label>{{ __('Select balance')}}</label>
                                        <select class="custom-select" name="balance" required>
                                            <option value="main">{{ __('Main balance')}}</option>
                                            <option value="trivia">{{ __('Trivia')}} &amp; {{ __('Video balance')}} </option>
                                        </select>
                                        <div class="help-info">{{ __('Current balance: TZS 0')}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Phone Number')}}</label>
                                        <input type="tel" name="phone" value="{{ Auth::user()->phone }}" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Amount to withdraw')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    {{ __('TZS')}}
                                                </div>
                                            </div>
                                            <input min="12000" max="20000" type="text" name="amount" id="amount" class="form-control currency" required>
                                        </div>
                                        <div class="help-info">{{ __('You can withdraw an amount not less than TZS 12,000 and not more than TZS 20,000 per day.')}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Amount to deposit')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    {{ __('TZS')}}
                                                </div>
                                            </div>
                                            <input type="text" name="deposit" id="deposit" class="form-control currency" required readonly>
                                        </div>
                                        <div class="help-info"><strong>{{ __('Fee: TZS 900.00')}}</strong></div>
                                    </div>
                                </fieldset>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">{{ __('Withdraw')}}</button>
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
<script src="{{ asset('assets/bundles/cleave-js/dist/cleave.min.js')}}"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/transaction.js')}}"></script>
@endsection
@endsection