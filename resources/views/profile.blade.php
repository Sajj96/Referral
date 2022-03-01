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