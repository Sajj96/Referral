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
                                            <th>{{ __('Referrer')}}</th>
                                            <th>{{ __('Referrals')}}</th>
                                            <th>{{ __('Joined On')}}</th>
                                            <th>{{ __('Status')}}</th>
                                            <th>{{ __('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
<script type="text/javascript">
  $(function () {
    
    var table = $('#tableExport').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'username', name: 'username'},
            {data: 'phone', name: 'phone'},
            {data: 'email', name: 'email'},
            {data: 'referrer', name: 'referrer'},
            {data: 'referrals', name: 'referrals'},
            {data: 'joined', name: 'joined'},
            {data: 'status', name: 'status',orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [[1, 'asc']]
    });
    
    $(document).on('click','.btn-action', function(){
        var id = $(this).data('class');
        $('.activate-form').each(function(){
            var form_id = $(this).data('id');
            if(form_id === id) {
                $(this).submit();
            }
        })
    });
  });
</script>
@endsection
@endsection