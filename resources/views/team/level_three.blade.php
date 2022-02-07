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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Downlines')}}</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-info">{{ __('Level 3')}}</a>
                                <a href="#" class="btn btn-primary">{{ $downlines[0]->username != null ? count($downlines) : '0' }} {{ __('Referral')}}</a>
                                <a href="#" class="btn btn-success">{{ __('Total Earned TZS ')}} {{ $downlines[0]->username != null ? count($activeReferrals) * 5000  : '0.00' }} </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Username</th>
                                            <th>Phone No</th>
                                            <th>Earned</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($downlines[0]->username != null)
                                        @foreach($downlines as $key=>$rows)
                                        <tr>
                                            <td>
                                                {{ $serial++ }}
                                            </td>
                                            <td>{{ $rows->username }}</td>
                                            <td>{{ $rows->phone }}</td>
                                            <td>{{ number_format(5000,2) }}</td>
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
                                        @endif
                                    </tbody>
                                </table>
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