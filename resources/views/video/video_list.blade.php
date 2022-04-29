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
                            <h4>{{ __('Videos')}}</h4>
                        </div>
                        @include('flash-message')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>{{ __('Title')}}</th>
                                            <th>{{ __('Video')}}</th>
                                            <th>{{ __('Uploaded On')}}</th>
                                            <th>{{ __('Status')}}</th>
                                            <th>{{ __('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($videos as $key=>$rows)
                                        <tr>
                                            <td>
                                                {{ $serial++ }}
                                            </td>
                                            <td>{{ strip_tags($rows->title) }}</td>
                                            <td>{{ $rows->video }}</td>
                                            <td>{{ $rows->created_at->format('M, d Y') }}</td>
                                            @if($rows->status == 1)
                                            <td>
                                                <div class="badge badge-primary">{{ __('Published')}}</div>
                                            </td>
                                            @else
                                            <td>
                                                <div class="badge badge-warning">{{ __('Pending')}}</div>
                                            </td>
                                            @endif
                                            <td>
                                                <a class="btn btn-danger btn-action delete" id="delete" onclick="event.preventDefault(); document.getElementById('delete-form').submit();" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a>
                                            </td>
                                            <form id="delete-form" action="{{ route('video.delete') }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $rows->id }}">
                                            </form>
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
@endsection
@section('page-specific-js')
<script src="{{ asset('assets/js/page/datatables.js')}}"></script>
@endsection
@endsection