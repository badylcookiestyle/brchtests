@extends('layouts.app')
@section('content')
    <section class="container">

        <form class="float-right" action="{{route('home')}}">
            @csrf
            @method('get')
            <button type="submit"  class="btn btn-dark float-right mt-1 ml-2 ">
                {{__('home')}}
            </button>
        </form>
        @if($canEdit==true)
        <form class="float-right" action="{{route('questionIndex',["id"=>$questions[0]->test_id])}}">
            @csrf
            @method('get')
            <button type="submit"  class="btn btn-info float-right mt-1 ml-2 ">
                {{__('edit')}}
            </button>
        </form>
        @endif
        <div id="score-section">
            <button class="btn btn-dark float-right" id="again">solve this test again</button>
            <div id="score"></div>
        </div>
        <div id="test-section">

            <h1>{{$testData->name}}</h1>
            <p>{{$testData->description}}</p>
            <form name="test-form">
            @php
                $counter = 1;
            @endphp
            @forelse($questions as $question)
                <h2>{{$question->question}}</h2>
                <div class="form-check  " id="q{{$counter}}">

                    <br>
                    <input class="form-check-input" type="radio" name="questionRadios{{$counter}}" id="exampleRadios1"
                           value="1">

                    <label class="form-check-label" for="questionRadios{{$counter}}">
                        {{$question->first_answer}}
                    </label><br>
                    <input class="form-check-input" type="radio" name="questionRadios{{$counter}}" id="exampleRadios2"
                           value="2">
                    <label class="form-check-label" for="questionRadios{{$counter}}">
                        {{$question->second_answer}}
                    </label><br>
                    @if($question->question_type!="yes_or_no")
                        <input class="form-check-input" type="radio" name="questionRadios{{$counter}}"
                               id="exampleRadios3" value="3">

                        <label class="form-check-label" for="questionRadios{{$counter}}">
                            {{$question->third_answer}}
                        </label><br>
                        <input class="form-check-input" type="radio" name="questionRadios{{$counter}}"
                               id="exampleRadios4" value="4">
                        <label class="form-check-label" for="questionRadios{{$counter}}">
                            {{$question->fourth_answer}}
                        </label>

                    @endif
                    @php
                        $counter++;
                    @endphp
                </div>

            @empty
                <h1>There aren't any questions yet :/</h1>
            @endforelse
            @php
                if($counter>1){
                    $testId=$question->test_id;
                }
                else{
                    $testId=0;
                }
            @endphp
            </form>
            <button id="check" class="btn btn-lg btn-success mt-5">check</button>
        </div>
    </section>
    <script>
        $("#score-section").toggle()
        var testId={{$testId}};
        var counter = -1 + {{$counter}};
        var answers = [];</script>
    <script src="{{ asset('js/getAnswers.js') }}">


    </script>
@endsection
