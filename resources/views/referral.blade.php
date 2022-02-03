@extends('layouts.app')

@section('content')
@include('layouts.header')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Share this link to your friends and earn when register with us!</h4>
                        </div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-3">
                                    <div class="card l-bg-cyan">
                                        <div class="card-statistic-3">
                                            <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                                            <div class="card-content">
                                                <h4 class="card-title">{{ __('References')}}</h4>
                                                <span class="font-20">{{ count(Auth::user()->referrals)  ?? '0' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-9 col-sm-9 col-xs-9">
                                    <form method="POST">
                                        <div class="form-group">
                                            <input id="link" type="text" class="form-control" name="link" value="{{ Auth::user()->referral_link }}">
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="button" data-clipboard-target="#link" class="btn btn-lg btn-round btn-primary">
                                                <i class="fas fa-copy"></i> Click here to copy your referral link
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center pt-0">
                            <div class="font-weight-bold mb-2 text-small">{{ __('Share on Social')}}</div>
                            <a href="https://www.facebook.com/" class="btn btn-social btn-facebook" data-toggle="tooltip" title="Facebook">
                                <span class="fab fa-facebook"></span> Facebook
                            </a>
                            <a href="https://twitter.com/" class="btn btn-social btn-twitter" data-toggle="tooltip" title="Twitter">
                                <span class="fab fa-twitter"></span> Twitter
                            </a>
                            <a href="https://www.linkedin.com/" class="btn btn-social btn-linkedin" data-toggle="tooltip" title="LinkedIn">
                                <span class="fab fa-linkedin"></span> LinkedIn
                            </a>
                            <a href="https://www.instagram.com/" class="btn btn-social btn-instagram" data-toggle="tooltip" title="Instagram">
                                <span class="fab fa-instagram"></span> Instagram
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('layouts.footer')
@section('js-libraries')
<script src="{{ asset('assets/bundles/clipboard/clipboard.min.js')}}"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/referral.js')}}"></script>
@endsection
@endsection