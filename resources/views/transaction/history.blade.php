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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tableExport">
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
                                        @foreach($withdraws as $key=>$rows)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ ($rows->created_at)->format('Y-m-d H:m:s') }}</td>
                                            <td>{{ $rows->amount }}</td>
                                            <td>{{ $rows->phone }}</td>
                                            <td>{{ $rows->transaction_type }}</td>
                                            @if($rows->status == 0)
                                            <td><div class="badge badge-light badge-shadow">Pending</div></td>
                                            @elseif($rows->status == 1)
                                            <td><div class="badge badge-success badge-shadow">Paid</div></td>
                                            @else
                                            <td><div class="badge badge-danger badge-shadow">Cancelled</div></td>
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
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/datatables.js')}}"></script>
@endsection
@endsection