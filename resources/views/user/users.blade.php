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
                            <h4>{{ __('Users')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tableExport">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>{{ __('Full name')}}</th>
                                            <th>{{ __('Username')}}</th>
                                            <th>{{ __('Phone')}}</th>
                                            <th>{{ __('Email')}}</th>
                                            <th>{{ __('Referrals')}}</th>
                                            <th>{{ __('Joined On')}}</th>
                                            <th>{{ __('Status')}}</th>
                                            <th>{{ __('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $key=>$rows)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $rows->name }}</td>
                                            <td>{{ $rows->username }}</td>
                                            <td>{{ $rows->phone }}</td>
                                            <td>{{ $rows->email }}</td>
                                            <td>{{ count($rows->referrals)  ?? '0' }}</td>
                                            <td>{{ ($rows->created_at)->format('M d Y') }}</td>
                                            @if($rows->active == 1)
                                            <td><div class="badge badge-success badge-shadow">Active</div></td>
                                            @else
                                            <td><div class="badge badge-light badge-shadow">Inactive</div></td>
                                            @endif
                                            <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
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