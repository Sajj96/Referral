@extends('layouts.app')

@section('content')
@include('layouts.header')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box">
                        <div class="card-body">
                            <div class="author-box-center">
                                <figure class="avatar mr-2 avatar-lg bg-success text-white" data-initial="{{strtoupper(substr(Auth::user()->name,0,2))}}"></figure>
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a href="#">{{ Auth::user()->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Account Details')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        {{ __('Total Balance')}}
                                    </span>
                                    <span class="float-right text-muted">
                                        TZS {{ number_format($balance,2) }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        {{ __('Profit')}}
                                    </span>
                                    <span class="float-right text-muted">
                                        TZS {{ number_format($profit,2) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    @include('flash-message')
                    <div class="card">
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
                        <div class="padding-20">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab" aria-selected="true">{{ __('About')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#settings" role="tab" aria-selected="false">{{ __('Edit Profile')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                                    <div class="row">
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>{{ __('Username')}}</strong>
                                            <br>
                                            <p class="text-muted">{{ Auth::user()->username }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>{{ __('Full Name')}}</strong>
                                            <br>
                                            <p class="text-muted">{{ Auth::user()->name }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>{{ __('Mobile')}}</strong>
                                            <br>
                                            <p class="text-muted">{{ Auth::user()->phone }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>{{ __('Email')}}</strong>
                                            <br>
                                            <p class="text-muted">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="section-title">{{ __('References')}}</div>
                                    <ul>
                                        <li>{{ __('Referred By:')}} {{ Auth::user()->referrer->name ?? 'Not Specified' }}</li>
                                        <li>{{ __('Referral Link:')}} <a href="{{ Auth::user()->referral_link }}">{{ Auth::user()->referral_link }}</a></li>
                                        <li>{{ __('Referral Number:')}} {{ count(Auth::user()->referrals)  ?? '0' }}</li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab3">
                                    <form method="post" class="needs-validation" action="{{ route('profile.update')}}">
                                        @csrf
                                        <div class="card-header">
                                            <h4>{{ __('Edit Details')}}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label>{{ __('Full Name')}}</label>
                                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                                                    <div class="invalid-feedback">
                                                        {{ __('Please fill in the name')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>{{ __('Username')}}</label>
                                                    <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}" required readonly>
                                                    <div class="invalid-feedback">
                                                        {{ __('Please fill in the username')}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label>{{ __('Email')}}</label>
                                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                                                    <div class="invalid-feedback">
                                                        {{ __('Please fill in the email')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>{{ __('Phone')}}</label>
                                                    <input id="phone" type="tel" class="form-control" name="phone" value="{{ Auth::user()->phone }}" readonly required>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>{{ __('New password')}}</label>
                                                    <input type="password" class="form-control" name="password" placeholder="******">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary" type="submit">{{ __('Save Changes')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('layouts.footer')
@endsection