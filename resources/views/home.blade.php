@extends('layouts.app')

@section('general-css')
<link rel="stylesheet" href="{{ asset('assets/bundles/jqvmap/dist/jqvmap.min.css')}}">
@endsection

@section('content')
@include('layouts.header')
<!-- Main Content -->
<div class="main-content">
    <h4 class="section-title mb-3">Welcome {{Auth::user()->name}}.</h4>
    @if(Auth::user()->user_type == 1)
    <section class="section">
        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-bg">
                        <div class="p-t-20 d-flex justify-content-between">
                            <div class="col">
                                <h6 class="mb-0">{{ __('All Users')}}</h6>
                                <span class="font-weight-bold mb-0 font-20">{{ $all_users }}</span>
                            </div>
                            <i class="fas fa-users card-icon col-cyan font-30 p-r-30"></i>
                        </div>
                        <canvas id="chart-1" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-bg">
                        <div class="p-t-20 d-flex justify-content-between">
                            <div class="col">
                                <h6 class="mb-0">{{ __('Active Users')}}</h6>
                                <span class="font-weight-bold mb-0 font-20">{{ $active_users }}</span>
                            </div>
                            <i class="fas fa-user-check card-icon col-orange font-30 p-r-30"></i>
                        </div>
                        <canvas id="chart-4" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-bg">
                        <div class="p-t-20 d-flex justify-content-between">
                            <div class="col">
                                <h6 class="mb-0">{{ __('Withdraw Requests')}}</h6>
                                <span class="font-weight-bold mb-0 font-20">{{ $withdraw_requests }}</span>
                            </div>
                            <i class="fas fa-money-bill-alt card-icon col-purple font-30 p-r-30"></i>
                        </div>
                        <canvas id="chart-2" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-bg">
                        <div class="p-t-20 d-flex justify-content-between">
                            <div class="col">
                                <h6 class="mb-0">{{ __('Total Earnings')}}</h6>
                                <span class="font-weight-bold mb-0 font-20">TZS {{ $system_earnings }}</span>
                            </div>
                            <i class="fas fa-hand-holding-usd card-icon col-green font-30 p-r-30"></i>
                        </div>
                        <canvas id="chart-3" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card ">
                    <div class="card-header">
                        <h4>Revenue chart</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <div id="chart1"></div>
                                <div class="row mb-0">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="list-inline text-center">
                                            <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle" class="col-green"></i>
                                                <h5 class="m-b-0">$675</h5>
                                                <p class="text-muted font-14 m-b-0">Weekly Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="list-inline text-center">
                                            <div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle" class="col-orange"></i>
                                                <h5 class="m-b-0">$1,587</h5>
                                                <p class="text-muted font-14 m-b-0">Monthly Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="list-inline text-center">
                                            <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle" class="col-green"></i>
                                                <h5 class="mb-0 m-b-0">$45,965</h5>
                                                <p class="text-muted font-14 m-b-0">Yearly Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row mt-5">
                                    <div class="col-7 col-xl-7 mb-3">Total customers</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">8,257</span>
                                        <sup class="col-green">+09%</sup>
                                    </div>
                                    <div class="col-7 col-xl-7 mb-3">Total Income</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">$9,857</span>
                                        <sup class="text-danger">-18%</sup>
                                    </div>
                                    <div class="col-7 col-xl-7 mb-3">Project completed</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">28</span>
                                        <sup class="col-green">+16%</sup>
                                    </div>
                                    <div class="col-7 col-xl-7 mb-3">Total expense</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">$6,287</span>
                                        <sup class="col-green">+09%</sup>
                                    </div>
                                    <div class="col-7 col-xl-7 mb-3">New Customers</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">684</span>
                                        <sup class="col-green">+22%</sup>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <h2 class="mb-3 font-18">{{ __('TZS')}} {{ number_format(13000,2) }}</h2>
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
            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-purple">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="fas fa-money-bill-alt"></i></div>
                        <div class="card-content">
                            <h4 class="card-title">{{ __('Withdrawn')}}</h4>
                            <span class="font-20">{{ __('TZS')}} {{ number_format($withdrawn,2) }}</span>
                            <div class="progress mt-1 mb-1" data-height="8">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0 text-sm">
                                <span class="text-nowrap">From Main balance</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-cyan">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="far fa-question-circle"></i></div>
                        <div class="card-content">
                            <h4 class="card-title">{{ __('Trivia Questions')}}</h4>
                            <span class="font-20">TZS 1,258</span>
                            <div class="progress mt-1 mb-1" data-height="8">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0 text-sm">
                                <span class="text-nowrap">Earnings</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-orange">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="fas fa-play-circle"></i></div>
                        <div class="card-content">
                            <h4 class="card-title">{{ __('Video')}}</h4>
                            <span class="font-20">TZS 2,658</span>
                            <div class="progress mt-1 mb-1" data-height="8">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0 text-sm">
                                <span class="text-nowrap">Earnings</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-green">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="fab fa-whatsapp"></i></div>
                        <div class="card-content">
                            <h4 class="card-title">{{ __('WhatsApp Status')}}</h4>
                            <span class="font-20">{{ __('TZS')}} {{ number_format(0,2) }}</span>
                            <div class="progress mt-1 mb-1" data-height="8">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0 text-sm">
                                <span class="text-nowrap">Earnings</span>
                            </p>
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
<script src="{{ asset('assets/js/page/index.js')}}"></script>
@endsection
@endif
@endsection