@extends('layouts.app')

@section('content')
@include('layouts.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">{{ __('Capital')}}</h5>
                                        <h2 class="mb-3 font-18">TZS 5,000.00</h2>
                                        <p class="mb-0"><span class="col-green"></span></p>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('assets/img/banner/1.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15"> {{ __('Expenses')}}</h5>
                                        <h2 class="mb-3 font-18">TZS 1,287.00</h2>
                                        <p class="mb-0"><span class="col-orange"></span></p>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('assets/img/banner/3.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">{{ __('Profit')}}</h5>
                                        <h2 class="mb-3 font-18">TZS 0.00</h2>
                                        <p class="mb-0"><span class="col-green"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('assets/img/banner/2.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">{{ __('Total Balance')}}</h5>
                                        <h2 class="mb-3 font-18">TZS 4,697</h2>
                                        <p class="mb-0"><span class="col-green"></span></p>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('assets/img/banner/4.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-4 col-lg-6">
                <div class="card l-bg-purple">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="fas fa-money-bill-alt"></i></div>
                        <div class="card-content">
                            <h4 class="card-title">{{ __('Withdrawn')}}</h4>
                            <span class="font-20">TZS 10,225</span>
                            <div class="progress mt-1 mb-1" data-height="8">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0 text-sm">
                                <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card l-bg-green">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="far fa-smile"></i></div>
                        <div class="card-content">
                            <h4 class="card-title">{{ __('Meme Earnings')}}</h4>
                            <span class="font-20">TZS 524</span>
                            <div class="progress mt-1 mb-1" data-height="8">
                                <div class="progress-bar l-bg-purple" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0 text-sm">
                                <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card l-bg-cyan">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="far fa-question-circle"></i></div>
                        <div class="card-content">
                            <h4 class="card-title">{{ __('Trivia Questions Earnings')}}</h4>
                            <span class="font-20">TZS 1,258</span>
                            <div class="progress mt-1 mb-1" data-height="8">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0 text-sm">
                                <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card l-bg-orange">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="fas fa-play-circle"></i></div>
                        <div class="card-content">
                            <h4 class="card-title">{{ __('Video')}} &amp; {{ __('Ads Earning')}}</h4>
                            <span class="font-20">TZS 2,658</span>
                            <div class="progress mt-1 mb-1" data-height="8">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0 text-sm">
                                <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('layouts.footer')
@section('page-specific-js')
<script src="{{ asset('assets/js/page/index.js')}}"></script>
@endsection
@endsection