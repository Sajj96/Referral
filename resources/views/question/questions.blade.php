@extends('layouts.app')

@section('general-css')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
@include('layouts.header')
<div class="main-content">
    <section class="section">
        @if(Auth::user()->user_type == 1)
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Questions')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Options</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($questions as $key=>$rows)
                                        <tr>
                                            <td>
                                                {{ $serial++ }}
                                            </td>
                                            <td>{{ $rows->question }}</td>
                                            <td>{{ $rows->answer }}</td>
                                            <td>{{ $rows->options }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
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
        @else
        <div class="section-body">
            <div class="row info_box activeInfo">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Some Rules of this Quiz!')}}</h4>
                        </div>
                        <div class="card-body">
                            <ol class="list-group list-group-flush">
                                <li class="list-group-item">{{ __('You will have only 15 seconds per each question.')}}</li>
                                <li class="list-group-item">{{ __('Once you select your answer, it can\'t be undone.')}}</li>
                                <li class="list-group-item">{{ __('You can\'t select any option once time goes off.')}}</li>
                                <li class="list-group-item">{{ __('You can\'t exit from the Quiz while you\'re playing.')}}</li>
                                <li class="list-group-item">{{ __('You\'ll get points on the basis of your correct answers.')}}</li>
                            </ol>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary start">{{ __('Start quiz')}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row quiz_box">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Answer, Learn and Earn')}}</h4>
                            <div class="card-header-action">
                                <div class="btn btn-info"><span class="time_left_txt">{{ __('Time Left')}}</span> <span class="timer_sec">15</span></div>
                            </div>
                            <div class="time_line"></div>
                        </div>
                        <div class="card-body">
                            <div class="que_text">

                            </div>
                            <div class="option_list">

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="total_que">

                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary next_btn">{{ __('Next Question')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row result_box">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            <h4 class="complete_text">{{ __('You\'ve completed the Quiz!')}}</h4>
                            <div class="score_text">

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary restart">{{ __('Restart')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
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
<script src="{{ asset('assets/js/page/questions.js')}}"></script>
@endsection
@endsection