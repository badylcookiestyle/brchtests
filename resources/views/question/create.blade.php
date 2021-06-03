@extends('layouts.app')
@section('content')
    <body>
    <div class="container">
        <div id="currentQuestions">
            @forelse ($testData as $test)
             <div class='border-top'

                 <h4 class="text-dark font-weight-bold">{{$test->question}}</h4>
                 <h5 class='ml-2 text-muted'>{{$test->first_answer}}</h5>
                 <h5 class='ml-2 text-muted'>{{$test->second_answer}}</h5>
                @if($test->question_type=="4_questions")
                 <h5 class='ml-2 text-muted'>{{$test->third_answer}}</h5>
                 <h5 class='ml-2 text-muted'>{{$test->fourth_answer}}</h5>
                @endif
             </div>
            @empty
                <h3>There aren't any questions yet</h3>
        @endforelse
        </div>
        <h1>{{__("create_question")}}</h1>
            <li  class="list-group-item list-group-item-action list-group-item-danger" id="errorQuestion"></li>
            <li  class="list-group-item list-group-item-action list-group-item-danger" id="errorTestType"></li>
             <li  class="list-group-item list-group-item-action list-group-item-danger" id="correctAnswer"></li>
            <li  class="list-group-item list-group-item-action list-group-item-danger" id="errorAnswer1"></li>
            <li  class="list-group-item list-group-item-action list-group-item-danger" id="errorAnswer2"></li>
            <li  class="list-group-item list-group-item-action list-group-item-danger" id="errorAnswer3"></li>
            <li  class="list-group-item list-group-item-action list-group-item-danger" id="errorAnswer4"></li>
        <form action="" id="justAForm"enctype="multipart/form-data" method="GET">
            @csrf
            @method("GET")

            <div class="form-group">
                <label for="testQuestion">{{__("question")}}</label>
                <input type="text" class="form-control" id="testQuestion" name="testQuestion" placeholder="Enter a question">

            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    {{__("Yes or No")}}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"  >
                <label class="form-check-label" for="flexRadioDefault2">
                    {{__("4 questions")}}
                </label>
            </div>
            <div class="form-group ">
                <input class="form-check-input testAnswer1" type="radio" name="correctAnswer" id="correctAnswer1"   >
                <label for="testAnswer1" class="testAnswer1">{{__("test_answer_1")}}</label>

                <input type="text" class="form-control testAnswer1" id="testAnswer1" name="testAnswer1" placeholder="Enter a Answer">

            </div>
            <div class="form-group ">
                <input class="form-check-input testAnswer2" type="radio" name="correctAnswer" id="correctAnswer2" >
                <label for="testAnswer2" class="testAnswer2">{{__("test_answer_2")}}</label>

                <input type="text" class="form-control testAnswer2" id="testAnswer2"  name="testAnswer2" placeholder="Enter a Answer">
            </div>
            <div class="form-group ">
                <input class="form-check-input testAnswer3" type="radio"  name="correctAnswer" id="correctAnswer3" >
                <label for="testAnswer3" class="testAnswer3">{{__("test_answer_3")}}</label>
                <input type="text" class="form-control testAnswer3" id="testAnswer3" name="testAnswer3" placeholder="Enter a Answer">

            </div>
            <div class="form-group ">
                <input class="form-check-input testAnswer4" type="radio"  name="correctAnswer" id="correctAnswer4" >
                <label for="testAnswer4" class="testAnswer4">{{__("test_answer_4")}}</label>

                <input type="text" class="form-control testAnswer4" id="testAnswer4" name="testAnswer4" placeholder="Enter a Answer">
            </div>
            <button id="btn-add"class="btn btn-success">{{__('create')}}</button>
        </form>
    </div>
    </body>
    <script>var currentId={{$id}}</script>
    <script src="{{ asset('js/question.js') }}" >var currentId={{$id}}</script>
@endsection

