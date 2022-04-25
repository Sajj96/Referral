@extends('layouts.app')

@section('general-css')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bundles/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bundles/intl-tel-input/css/intlTelInput.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css')}}">
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
                                    <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#transaction" role="tab" aria-selected="false">{{ __('Transactions')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#settings" role="tab" aria-selected="false">{{ __('Settings')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#referrals1" role="tab" aria-selected="false">{{ __('Level 1 Referrals')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab5" data-toggle="tab" href="#referrals2" role="tab" aria-selected="false">{{ __('Level 2 Referrals')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab6" data-toggle="tab" href="#referrals3" role="tab" aria-selected="false">{{ __('Level 3 Referrals')}}</a>
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
                                        <a href="{{ route('user.deactivate', $user->id)}}" onclick="event.preventDefault(); document.getElementById('deactivate-form').submit();" class="btn btn-primary mr-1">
                                            {{ __('Deactivate') }}
                                        </a>
                                        <form id="deactivate-form" action="{{ route('user.deactivate', $user->id)}}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        <a href="{{ route('user.delete', $user->id)}}" onclick="event.preventDefault(); document.getElementById('activate-form').submit();" class="btn btn-danger mr-1">
                                            {{ __('Delete') }}
                                        </a>
                                        <form id="activate-form" action="{{ route('user.delete', $user->id)}}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="transaction" role="tabpanel" aria-labelledby="profile-tab2">
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
                                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab3">
                                    <form method="post" class="needs-validation" action="{{ route('profile.edit')}}">
                                        @csrf
                                        <div class="card-header">
                                            <h4>{{ __('Edit User Details')}}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label>{{ __('Full Name')}}</label>
                                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                                    <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}" required>
                                                    <div class="invalid-feedback">
                                                        {{ __('Please fill in the name')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>{{ __('Username')}}</label>
                                                    <input type="text" class="form-control" name="username" value="{{ $user->username }}" required readonly>
                                                    <div class="invalid-feedback">
                                                        {{ __('Please fill in the username')}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-7 col-12">
                                                    <label>{{ __('Email')}}</label>
                                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                                    <div class="invalid-feedback">
                                                        {{ __('Please fill in the email')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5 col-12">
                                                    <label>{{ __('Phone')}}</label>
                                                    <input id="phone" type="tel" class="form-control" name="phone" value="{{ $user->phone }}" required>
                                                </div>
                                                <div class="form-group col-md-12 col-12">
                                                    <label for="country">{{ __('Country') }}</label>
                                                    <select name="country" id="address-country" name="country" class="form-control custom-select" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>{{ __('Referrer')}}</label>
                                                    <select class="form-control select2" name="referrer" required>
                                                        @foreach($users as $key => $rows)
                                                        <option {{ $user->referrer->id == $rows->id ? 'selected' : '' }} value="{{ $rows->id }}">{{ $rows->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary" type="submit">{{ __('Save Changes')}}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="referrals1" role="tabpanel" aria-labelledby="profile-tab4">
                                    <div class="card-header">
                                        <h4>{{ __('Referrals Level 1')}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-3">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Username</th>
                                                        <th>Phone</th>
                                                        <th>Earned</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($level_1_downlines as $key=>$rows)
                                                    <tr>
                                                        <td>
                                                            {{ $serial_1++ }}
                                                        </td>
                                                        <td>{{ $rows->username }}</td>
                                                        <td>{{ $rows->phone }}</td>
                                                        <td>{{ $rows->active == 1 ? number_format(6000,2) : '0.00' }}</td>
                                                        @if($rows->active == 1)
                                                        <td>
                                                            <div class="badge badge-success badge-shadow">{{ __('Active') }}</div>
                                                        </td>
                                                        @else
                                                        <td>
                                                            <div class="badge badge-light badge-shadow">{{ __('Inactive') }}</div>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="referrals2" role="tabpanel" aria-labelledby="profile-tab5">
                                    <div class="card-header">
                                        <h4>{{ __('Referrals Level 2')}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-4">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Username</th>
                                                        <th>Phone</th>
                                                        <th>Earned</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($level_2_downlines as $key=>$rows)
                                                    <tr>
                                                        <td>
                                                            {{ $serial_2++ }}
                                                        </td>
                                                        <td>{{ $rows->username }}</td>
                                                        <td>{{ $rows->phone }}</td>
                                                        <td>{{ $rows->active == 1 ? number_format(3000,2) : '0.00' }}</td>
                                                        @if($rows->active == 1)
                                                        <td>
                                                            <div class="badge badge-success badge-shadow">{{ __('Active') }}</div>
                                                        </td>
                                                        @else
                                                        <td>
                                                            <div class="badge badge-light badge-shadow">{{ __('Inactive') }}</div>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="referrals3" role="tabpanel" aria-labelledby="profile-tab6">
                                    <div class="card-header">
                                        <h4>{{ __('Referrals Level 3')}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-5">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Username</th>
                                                        <th>Phone</th>
                                                        <th>Earned</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($level_3_downlines as $key=>$rows)
                                                    <tr>
                                                        <td>
                                                            {{ $serial_3++ }}
                                                        </td>
                                                        <td>{{ $rows->username }}</td>
                                                        <td>{{ $rows->phone }}</td>
                                                        <td>{{ $rows->active == 1 ? number_format(1000,2) : '0.00' }}</td>
                                                        @if($rows->active == 1)
                                                        <td>
                                                            <div class="badge badge-success badge-shadow">{{ __('Active') }}</div>
                                                        </td>
                                                        @else
                                                        <td>
                                                            <div class="badge badge-light badge-shadow">{{ __('Inactive') }}</div>
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
<script src="{{ asset('assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js')}}"></script>
<script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js')}}"></script>
<script src="{{ asset('assets/bundles/summernote/summernote-bs4.js')}}"></script>
<script src="{{ asset('assets/bundles/intl-tel-input/js/intlTelInput.min.js')}}"></script>
<script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/datatables.js')}}"></script>
<script type="text/javascript">
    var utilUrl = "{{ asset('assets/bundles/intl-tel-input/js/utils.js?1638200991544')}}"
</script>
<script src="{{ asset('assets/js/page/auth-register.js')}}"></script>
@endsection
@endsection