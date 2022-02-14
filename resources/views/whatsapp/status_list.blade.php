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
                            <h4>{{ __('WhatsApp Status List')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>{{ __('Description')}}</th>
                                            <th>{{ __('Media')}}</th>
                                            <th>{{ __('Posted On')}}</th>
                                            <th>{{ __('Status')}}</th>
                                            <th>{{ __('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($whatsapp_statuses as $key=>$rows)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $rows->description }}</td>
                                            <td>{{ $rows->media }}</td>
                                            <td>{{ ($rows->created_at)->format('M d Y') }}</td>
                                            @if($rows->status == 0)
                                            <td>
                                                <div class="badge badge-light badge-shadow">Pending</div>
                                            </td>
                                            @else
                                            <td>
                                                <div class="badge badge-primary badge-shadow">Published</div>
                                            </td>
                                            @endif
                                            <td>
                                                <a href="{{ route('whatsapp.edit', $rows->id) }}" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Edit" id="edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action" onclick="event.preventDefault(); document.getElementById('delete-form{{ $rows->id }}').submit();" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a>
                                                <form id="delete-form{{ $rows->id }}" action="{{ route('whatsapp.delete') }}" method="POST" class="d-none">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $rows->id }}">
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