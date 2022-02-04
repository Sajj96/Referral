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
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box">
                        <div class="card-body">
                            <div class="author-box-center">
                                <figure class="avatar mr-2 avatar-lg bg-success text-white" data-initial="{{strtoupper(substr($user->name,0,2))}}"></figure>
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a href="#">{{ $user->name }}</a>
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
                                        TZS 0.00
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        {{ __('Profit')}}
                                    </span>
                                    <span class="float-right text-muted">
                                        TZS 0.00
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
                                    <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab" aria-selected="false">{{ __('Transactions')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                                    <div class="row">
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>{{ __('Username')}}</strong>
                                            <br>
                                            <p class="text-muted">{{ $user->username }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>{{ __('Full Name')}}</strong>
                                            <br>
                                            <p class="text-muted">{{ $user->name }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>{{ __('Mobile')}}</strong>
                                            <br>
                                            <p class="text-muted">{{ $user->phone }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>{{ __('Email')}}</strong>
                                            <br>
                                            <p class="text-muted">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="section-title">{{ __('References')}}</div>
                                    <ul>
                                        <li>{{ __('Referred By:')}} {{ $user->referrer->name ?? 'Not Specified' }}</li>
                                        <li>{{ __('Referral Link:')}} <a href="{{ $user->referral_link }}">{{ $user->referral_link }}</a></li>
                                        <li>{{ __('Referral Number:')}} {{ count($user->referrals)  ?? '0' }}</li>
                                    </ul>
                                    <div class="card-footer text-right">
                                        @if($user->active == 1)
                                        <a href="{{ route('user.deactivate', $user->id)}}" onclick="event.preventDefault(); document.getElementById('deactivate-form').submit();" class="btn btn-danger mr-1">
                                            {{ __('Deactivate') }}
                                        </a>
                                        <form id="deactivate-form" action="{{ route('user.deactivate', $user->id)}}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        @else
                                        <a href="{{ route('user.activate', $user->id)}}" onclick="event.preventDefault(); document.getElementById('activate-form').submit();" class="btn btn-success mr-1">
                                            {{ __('Activate') }}
                                        </a>
                                        <form id="activate-form" action="{{ route('user.activate', $user->id)}}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                    <div class="card-header">
                                        <h4>{{ __('Transactions')}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>{{ __('Date')}}</th>
                                                        <th>{{ __('Amount')}}</th>
                                                        <th>{{ __('Phone')}}</th>
                                                        <th>{{ __('Type')}}</th>
                                                        <th>{{ __('Status')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($transactions as $key=>$rows)
                                                    <tr>
                                                        <td>{{ $serial++ }}</td>
                                                        <td>{{ ($rows->created_at)->format('M d Y') }}</td>
                                                        <td>{{ number_format($rows->amount,2) }}</td>
                                                        <td>{{ $rows->phone }}</td>
                                                        <td>{{ $rows->transaction_type }}</td>
                                                        @if($rows->status == 0)
                                                        <td>
                                                            <div class="badge badge-light badge-shadow">Pending</div>
                                                        </td>
                                                        @elseif($rows->status == 1)
                                                        <td>
                                                            <div class="badge badge-success badge-shadow">Paid</div>
                                                        </td>
                                                        @else
                                                        <td>
                                                            <div class="badge badge-danger badge-shadow">Cancelled</div>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
@section('js-libraries')
<script src="{{ asset('assets/bundles/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/datatables.js')}}"></script>
@endsection
@endsection