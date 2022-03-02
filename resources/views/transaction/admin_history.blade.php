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
                            <h4>{{ __('Transaction History')}}</h4>
                        </div>
                        @include('flash-message')
                        <div class="card-body">
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
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">All Transactions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="withdraw-tab3" data-toggle="tab" href="#withdraw3" role="tab" aria-controls="withdraw" aria-selected="false">Withdraw Requests</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="tableExport">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th>{{ __('Name')}}</th>
                                                    <th>{{ __('Date')}}</th>
                                                    <th>{{ __('Amount')}}</th>
                                                    <th>{{ __('Debit')}}</th>
                                                    <th>{{ __('Fee')}}</th>
                                                    <th>{{ __('Phone')}}</th>
                                                    <th>{{ __('Type')}}</th>
                                                    <th>{{ __('Status')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($transactions as $key=>$rows)
                                                <tr>
                                                    <td>{{ $serial_1++ }}</td>
                                                    <td>{{ $rows->name }}</td>
                                                    <td>{{ date('M d Y', strtotime($rows->created_at)) }}</td>
                                                    <td>{{ number_format($rows->amount,2) }}</td>
                                                    <td>{{ number_format($rows->amount_deposit,2) }}</td>
                                                    <td>{{ number_format($rows->fee,2) }}</td>
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
                                <div class="tab-pane fade" id="withdraw3" role="tabpanel" aria-labelledby="withdraw-tab3">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="tableExport1">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th>{{ __('Name')}}</th>
                                                    <th>{{ __('Date')}}</th>
                                                    <th>{{ __('Amount')}}</th>
                                                    <th>{{ __('Debit')}}</th>
                                                    <th>{{ __('Fee')}}</th>
                                                    <th>{{ __('Phone')}}</th>
                                                    <th>{{ __('Type')}}</th>
                                                    <th>{{ __('Status')}}</th>
                                                    <th>{{ __('Action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($withdraw_requests as $key=>$rows)
                                                <tr>
                                                    <td>{{ $serial_2++ }}</td>
                                                    <td>{{ $rows->name }}</td>
                                                    <td>{{ date('M d Y', strtotime($rows->created_at)) }}</td>
                                                    <td>{{ number_format($rows->amount,2) }}</td>
                                                    <td>{{ number_format($rows->amount_deposit,2) }}</td>
                                                    <td>{{ number_format($rows->fee,2) }}</td>
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
                                                    <td>
                                                        <a class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Accept" id="accept" onclick="event.preventDefault(); document.getElementById('accept-form').submit();"><i class="fas fa-check"></i></a>
                                                        <a class="btn btn-danger btn-action decline" id="decline" data-id="{{ $rows->id }}" data-toggle="tooltip" title="Decline"><i class="fas fa-times"></i></a>
                                                        <form id="accept-form" action="{{ route('withdraw.accept') }}" method="POST" class="d-none">
                                                            @csrf
                                                            <input type="hidden" name="withdraw_id" value="{{ $rows->id }}">
                                                        </form>
                                                    </td>
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
    </section>
</div>
@include('layouts.footer')
@section('js-libraries')
<script src="{{ asset('assets/bundles/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/buttons.flash.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/jszip.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js')}}"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/datatables.js')}}"></script>
@endsection
@endsection