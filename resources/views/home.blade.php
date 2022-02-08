@extends('layouts.app')

@section('general-css')
<link rel="stylesheet" href="{{ asset('assets/bundles/jqvmap/dist/jqvmap.min.css')}}">
@endsection

@section('content')
@include('layouts.header')
<!-- Main Content -->
<div class="main-content">
    @if(Auth::user()->user_type == 1)
    <section class="section">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-cyan">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4 class="pull-right">{{ __('All Users')}}</h4>
                        </div>
                        <div class="card-body pull-right">
                            {{ $all_users }}
                        </div>
                    </div>
                    <div class="card-chart">
                        <canvas id="chart-1" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-orange">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4 class="pull-right">{{ __('Active Users')}}</h4>
                        </div>
                        <div class="card-body pull-right">
                            {{ $active_users }}
                        </div>
                    </div>
                    <div class="card-chart">
                        <canvas id="chart-4" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-purple">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4 class="pull-right">{{ __('Withdraws')}}</h4>
                        </div>
                        <div class="card-body pull-right">
                            {{ $withdraw_requests }}
                        </div>
                    </div>
                    <div class="card-chart">
                        <canvas id="chart-2" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-green">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4 class="pull-right">{{ __('Total Earnings')}}</h4>
                        </div>
                        <div class="card-body pull-right">
                            TZS {{ $system_earnings }}
                        </div>
                    </div>
                    <div class="card-chart">
                        <canvas id="chart-3" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Revenue Chart</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item p-r-30"><i data-feather="arrow-up-circle" class="col-green"></i>
                                <h5 class="m-b-0">$675</h5>
                                <p class="text-muted font-14 m-b-0">Weekly Earnings</p>
                            </li>
                            <li class="list-inline-item p-r-30"><i data-feather="arrow-down-circle" class="col-orange"></i>
                                <h5 class="m-b-0">$1,587</h5>
                                <p class="text-muted font-14 m-b-0">Monthly Earnings</p>
                            </li>
                            <li class="list-inline-item p-r-30"><i data-feather="arrow-up-circle" class="col-green"></i>
                                <h5 class="mb-0 m-b-0">$45,965</h5>
                                <p class="text-muted font-14 m-b-0">Yearly Earnings</p>
                            </li>
                        </ul>
                        <div id="revenue"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
    <section class="section">
        <div class="row ">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15"> {{ __('Expenses')}}</h5>
                                        <h2 class="mb-3 font-18">{{ __('TZS')}} {{ number_format($expenses,2) }}</h2>
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
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">{{ __('Profit')}}</h5>
                                        <h2 class="mb-3 font-18">{{ __('TZS')}} {{ number_format($profit,2) }}</h2>
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
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">{{ __('Total Balance')}}</h5>
                                        <h2 class="mb-3 font-18">{{ __('TZS')}} {{ number_format($balance,2) }}</h2>
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
                <div class="card l-bg-green">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="fas fa-money-bill-alt"></i></div>
                        <div class="card-content">
                            <h4 class="card-title">{{ __('Withdrawn')}}</h4>
                            <span class="font-20">{{ __('TZS')}} {{ number_format($withdrawn,2) }}</span>
                            <div class="progress mt-1 mb-1" data-height="8">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card l-bg-orange">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="fas fa-play-circle"></i></div>
                        <div class="card-content">
                            <h4 class="card-title">{{ __('Video Earnings')}}</h4>
                            <span class="font-20">TZS 2,658</span>
                            <div class="progress mt-1 mb-1" data-height="8">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>
@include('layouts.footer')
@if(Auth::user()->user_type == 1)
@section('js-libraries')
<script src="{{ asset('assets/bundles/chartjs/chart.min.js')}}"></script>
<script src="{{ asset('assets/bundles/jquery.sparkline.min.js')}}"></script>
<script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{ asset('assets/bundles/jqvmap/dist/jquery.vmap.min.js')}}"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/widget-chart.js')}}"></script>
@endsection
@endif
@endsection