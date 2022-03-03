@extends('layouts.app')

@section('general-css')
<link rel="stylesheet" href="{{ asset('assets/bundles/jqvmap/dist/jqvmap.min.css')}}">
@endsection

@section('content')
@include('layouts.header')
<!-- Main Content -->
<div class="main-content">
    <h4 class="section-title mb-3">Hello, {{Auth::user()->username}}.</h4>
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
                                <span class="font-weight-bold mb-0 font-20">TZS {{ number_format($system_earnings,2) }}</span>
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
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="list-inline text-center">
                                            <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle" class="col-cyan"></i>
                                                <h5 class="m-b-0">TZS <span id="earning"></span></h5>
                                                <p class="text-muted font-14 m-b-0">Weekly Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="list-inline text-center">
                                            <div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle" class="col-orange"></i>
                                                <h5 class="m-b-0">TZS <span id="withdraw"></span></h5>
                                                <p class="text-muted font-14 m-b-0">Weekly Withdraws</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row mt-5">
                                    <div class="col-7 col-xl-7 mb-3">Today's New Active Users</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">{{ count($newUsers) }}</span>
                                        <sup class="col-green">0</sup>
                                    </div>
                                    <div class="col-7 col-xl-7 mb-3">Total Withdraws</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">TZS {{ number_format($totalWithdraw) }}</span>
                                        <sup class="text-danger">00</sup>
                                    </div>
                                    <div class="col-7 col-xl-7 mb-3">Today's Earnings</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">TZS {{ number_format($todayEarning) }}</span>
                                        <sup class="col-green">00</sup>
                                    </div>
                                    <div class="col-7 col-xl-7 mb-3">Inactive Users</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">{{ count($inactiveUsers) }}</span>
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
    @foreach($notification as $key=>$rows)
    <?php $end_date = date('Y-m-d', strtotime($rows->created_at . " + 2 days")); ?>
    @if(date('Y-m-d') < $end_date) <div class="alert alert-{{ $rows->type }} alert-has-icon alert-dismissible show fade">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            {{ $rows->message }}
        </div>
</div>
@endif
@endforeach
<section class="section">
    <div class="row ">
        <div id="card-expenses" class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15"> {{ __('Expenses')}}</h5>
                                    <span class="mb-3 font-18" id="expense-amount">{{ __('TZS')}} {{ number_format(13000) }}</span>
                                    <p class="mb-0 info"><span class="col-orange"></span>Registration Fee</p>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 pl-0 d-none d-lg-block d-md-none">
                                <div class="banner-img">
                                    <img src="{{ asset('assets/img/banner/3.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="card-profit" class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">{{ __('Net Profit')}}</h5>
                                    <span class="mb-3 font-18" id="profit-amount">{{ __('TZS')}} {{ number_format($profit) }}</span>
                                    <p class="mb-0 info"><span class="col-green"></span>
                                        Referral + Other Earnings
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 pl-0 d-none d-lg-block d-md-none">
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
            <div id="card-total" class="card">
                <div class="card-statistic-4">
                    <div class="card-icon card-icon-large d-none d-lg-none d-xl-none d-sm-block d-md-block"><i class="fas fa-credit-card"></i></div>
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr-0 pt-3">
                                <div class="card-content">
                                    <h4 id="balance" class="font-15">{{ __('Total Balance')}}</h4>
                                    <span class="mb-3 font-18" id="total-amount">{{ __('TZS')}} {{ number_format($balance) }}</span>
                                    <div class="progress mt-1 mb-1 d-block d-lg-none d-xl-none d-sm-block d-md-block" data-height="8">
                                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mb-0 text-sm d-block d-lg-none d-xl-none d-sm-block d-md-block">
                                        <span class="text-nowrap">Main balance</span>
                                    </p>
                                    <p class="mb-0 info"><span class="col-green"></span>Active Referral Earnings</p>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 pl-0 d-none d-lg-block d-md-none">
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
                    <div class="card-icon card-icon-large d-none d-md-block d-lg-block"><i class="fas fa-money-bill-alt"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">{{ __('Withdrawn')}}</h4>
                        <span class="font-20">{{ __('TZS')}} {{ number_format($withdrawn) }}</span>
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
                    <div class="card-icon card-icon-large d-none d-md-block d-lg-block"><i class="far fa-question-circle"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">{{ __('Trivia Questions')}}</h4>
                        <span class="font-20">{{ __('TZS')}} {{ number_format($question) }}</span>
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
                    <div class="card-icon card-icon-large d-none d-md-block d-lg-block"><i class="fas fa-play-circle"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">{{ __('Video')}}</h4>
                        <span class="font-20">{{ __('TZS')}} {{ number_format($video) }}</span>
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
                    <div class="card-icon card-icon-large d-none d-md-block d-lg-block"><i class="fab fa-whatsapp"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">{{ __('WhatsApp Status')}}</h4>
                        <span class="font-20">{{ __('TZS')}} {{ number_format($whatsapp) }}</span>
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
<script src="{{ asset('assets/js/page/widget-chart.js')}}"></script>
<script type="text/javascript">
    var transactions = <?php echo json_encode($transactionData); ?>;
</script>
<script src="{{ asset('assets/js/page/index.js')}}"></script>
@endsection
@endif
@section('page-specific-js')
<script>
    $(document).ready(function() {
        $(window).bind("resize", function() {
            if ($(this).width() < 1024) {
                $('#card-expenses').removeClass('col-xs-12');
                $('#card-expenses').addClass('col-xs-6');
                $('#card-profit').removeClass('col-xs-12');
                $('#card-profit').addClass('col-xs-6');

                $('#card-expenses').children().addClass('card-info');
                $('#card-expenses').children().removeClass('card');
                $('#card-profit').children().addClass('card-info');
                $('#card-profit').children().removeClass('card');
                $('#card-expenses').children().children().children().children().children().addClass('pl-5 pb-4');
                $('#card-profit').children().children().children().children().children().addClass('pl-5 pb-4');

                $('#card-total').addClass('l-bg-green');
                $('#card-total').children().removeClass('card-statistic-4');
                $('#card-total').children().addClass('card-statistic-3');
                $('#card-total').children().children().children().children().removeClass('pt-3');
                $('#card-total').children().children().removeClass('align-items-center')
                $('#total-amount').removeClass('font-18');
                $('#total-amount').addClass('font-20');
                $('#profit-amount').removeClass('mb-3');
                $('#profit-amount').addClass('mb-5');
                $('#balance').removeClass('font-15');
                $('#balance').addClass('card-title');
                $('.section-title').css('color', '#FFF');
                $('#card-expenses').css('color', '#FFF');
                $('#card-profit').css('color', '#FFF');

                $('.info').each(function() {
                    $(this).css('display','none');
                });

                $('.progress').each(function() {
                    $(this).addClass('progress-xs');
                });
            } else {
                $('#card-expenses').addClass('col-xs-12');
                $('#card-expenses').removeClass('col-xs-6');
                $('#card-profit').addClass('col-xs-12');
                $('#card-profit').removeClass('col-xs-6');

                $('#card-expenses').children().removeClass('card-info');
                $('#card-expenses').children().addClass('card');
                $('#card-profit').children().removeClass('card-info');
                $('#card-profit').children().addClass('card');
                $('#card-expenses').children().children().children().children().children().removeClass('pl-5 pb-4');
                $('#card-profit').children().children().children().children().children().removeClass('pl-5 pb-4');

                $('#card-total').removeClass('l-bg-green');
                $('#card-total').children().addClass('card-statistic-4');
                $('#card-total').children().removeClass('card-statistic-3');
                // $('#card-total').children().children().children().addClass('pt-3');
                $('#card-total').children().children().addClass('align-items-center')
                $('#total-amount').addClass('font-18');
                $('#total-amount').removeClass('font-20');
                $('#profit-amount').addClass('mb-3');
                $('#profit-amount').removeClass('mb-5');
                $('#balance').addClass('font-15');
                $('#balance').removeClass('card-title');
                $('.section-title').css('color', '#6c757d');
                $('#card-expenses').css('color', '#6c757d');
                $('#card-profit').css('color', '#6c757d');

                $('.info').each(function() {
                    $(this).css('display','block');
                });

                $('.progress').each(function() {
                    $(this).removeClass('progress-xs');
                });
            }
        }).trigger('resize');
    });
</script>
@endsection
@endsection