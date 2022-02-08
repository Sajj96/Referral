@extends('layouts.app')

@section('content')
@include('layouts.header')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row info_box activeInfo">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Some Rules of this Quiz!')}}</h4>
                        </div>
                        <div class="card-body" data-user="{{ Auth::user()->id }}">
                            <ol class="list-group list-group-flush">
                                <li class="list-group-item">{{ __('You will have only 15 seconds per each question.')}}</li>
                                <li class="list-group-item">{{ __('Once you select your answer, it can\'t be undone.')}}</li>
                                <li class="list-group-item">{{ __('You can\'t select any option once time goes off.')}}</li>
                                <li class="list-group-item">{{ __('You can\'t exit from the Quiz while you\'re playing.')}}</li>
                                <li class="list-group-item">{{ __('You\'ll get points on the basis of your correct answers.')}}</li>
                            </ol>
                        </div>
                        <div class="card-footer text-right">
                            @if(count($questionsList) != 0)
                            <button class="btn btn-primary start">{{ __('Start quiz')}}</button>
                            @else
                            {{ __('There is no Quiz currenctly')}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row quiz_box">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Answer and Earn')}}</h4>
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
                            <div class="result_info">
                                <div class="icon">
                                    <i class="fas fa-crown"></i>
                                </div>
                                <h4 class="complete_text">{{ __('You\'ve completed the Quiz!')}}</h4>
                                <div class="score_text">

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary restart">{{ __('Restart')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('layouts.footer')
@section('page-specific-js')
<script type="text/javascript">
    var questionsList = <?php echo json_encode($questionsList) ?>;
    var url = "{{ route('question.score')}}";
</script>
<script src="{{ asset('assets/js/page/questions.js')}}"></script>
@endsection
@endsection