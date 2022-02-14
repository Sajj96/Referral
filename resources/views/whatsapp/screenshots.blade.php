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
                            <h4>{{ __('WhatsApp Screenshots')}}</h4>
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
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>{{ __('Screenshot')}}</th>
                                            <th>{{ __('Uploaded On')}}</th>
                                            <th>{{ __('Status')}}</th>
                                            @if(Auth::user()->user_type == 1)
                                            <th>Uploaded By</th>
                                            <th>{{ __('Action')}}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($screenshots as $key=>$rows)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $rows->screenshot }}</td>
                                            <td>{{ $rows->created_at }}</td>
                                            @if($rows->status == 0)
                                            <td>
                                                <div class="badge badge-light badge-shadow">{{ __('Pending')}}</div>
                                            </td>
                                            @else
                                            <td>
                                                <div class="badge badge-success badge-shadow">{{ __('Paid')}}</div>
                                            </td>
                                            @endif
                                            @if(Auth::user()->user_type == 1)
                                            <td>{{ $rows->name }}</td>
                                            <td><a href="{{ route('screenshot.details', $rows->id)}}" class="btn btn-outline-primary">Detail</a></td>
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
<script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/datatables.js')}}"></script>
@endsection
@endsection