@extends('layouts.app')

@section('general-css')
<link rel="stylesheet" href="{{ asset('assets/bundles/intl-tel-input/css/intlTelInput.css')}}">
@endsection

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>{{ __('Register') }}</h4>
                    </div>
                    <div class="card-body">
                        @if(!empty($_GET['ref']))
                        <div class="alert alert-primary alert-has-icon">
                            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                            <div class="alert-body">
                                You were invited by:
                                <span class="alert-title"> {{ $_GET['ref'] }}</span>
                            </div>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="username">{{ __('Username') }}</label>
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username">
                                    <small class="form-text text-muted">
                                        Your user must be only one word, can contain letters and numbers, and must not contain
                                        spaces, special characters, or emoji.
                                    </small>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="phone">{{ __('Phone number') }}</label>
                                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone" style="padding: 10px 80px 10px 90px">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <span id="valid-msg" class="hide">✓ Valid</span>
                                    <span id="error-msg" class="hide"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="password" class="d-block">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror pwstrength" data-indicator="pwindicator" name="password" required autocomplete="new-password" placeholder="*********">
                                    <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="password2" class="d-block">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="*********">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="package">{{ __('Package') }}</label>
                                    <input id="package" type="text" class="form-control @error('package') is-invalid @enderror" name="package" value="Premium Package" readonly autocomplete="package">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="country">{{ __('Country') }}</label>
                                    <select name="country" id="address-country" class="form-control @error('country') is-invalid @enderror custom-select">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="mb-4 text-muted text-center">
                        Already Registered? <a href="{{ route('login') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js-libraries')
<script src="{{ asset('assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js')}}"></script>
<script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js')}}"></script>
<script src="{{ asset('assets/bundles/intl-tel-input/js/intlTelInput.min.js')}}"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/auth-register.js')}}"></script>
@endsection
@endsection