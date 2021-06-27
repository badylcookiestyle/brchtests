@extends('layouts.app')
@section('content')
    <body>
    <!-- Modal -->
    <div class="modal fade" id="changeImg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__("change_img")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="text-center">
                        <li class="list-group-item list-group-item-action list-group-item-danger"
                            id="errorImage"></li>
                    </ul>
                    <form method="post" id="upload-image-form" enctype="multipart/form-data">
                        @csrf
                        @method("POST")

                        <div class="form-group">
                            <input type="file" name="file" class="form-control" id="image-input">
                            <span class="text-danger" id="image-input-error"></span>
                        </div>

                        <div class="form-group">

                        </div>

                    </form>
                    <button class="btn btn-success" id="change-image-button">Upload</button>
                </div>

                <div class="modal-header">


                    <h5 class="modal-title" id="exampleModalLabel">{{__("change_description")}}</h5>


                </div>
                <div class="modal-body">
                    <form method="post" id="change-description-form">
                        @csrf
                        @method('POST')
                        <ul class="text-center">
                            <li class="list-group-item list-group-item-action list-group-item-danger"
                                id="errorDescription"></li>
                        </ul>
                        <div class="form-group">
                            <textarea class="form-control" id="new-decription-textarea"></textarea>
                        </div>

                        <div class="form-group">

                        </div>

                    </form>
                    <button type="submit" id="change-description-button" class="btn btn-success">Change</button>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <form class="float-right" action="{{route("testIndex",['id'=>$id])}}">
            @csrf
            @method('get')
            <button type="submit"  class="btn btn-success float-right mt-1 ml-2 ">
                {{__('use')}}
            </button>
        </form>
        <form class="float-right" action="{{route("testStats",['id'=>$id])}}">
            @csrf
            @method('get')
            <button type="submit"  class="btn btn-outline-info float-right mt-1 ml-2 ">
                {{__('stats')}}
            </button>
        </form>
        <div class="text-center">
            <button class="btn btn-info  " data-toggle="modal" data-target="#changeImg">
                <input type="hidden" id="ttoken" name="_token" value="{{ csrf_token() }}"/>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear"
                     viewBox="0 0 16 16">
                    <path
                        d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                    <path
                        d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                </svg>
            </button>
            <img class="img-fluid mb-5" style="max-height: 500px;  position: relative;"
                 src="{{ asset('storage/images/'.$description->file_path )}}" alt="There is no img">
            <div class="caption" style="position: absolute;
    top: 25%;
    left: 0;
    width: 100%;">
                <h1 class="text-light">{{__("edit_test")}}</h1>
            </div>
        </div>
        <div id="description" class="text-center my-5">
            <h2>Description</h2>
            <p id="description-paragraph">{{$description->description}}</p>
        </div>
        <div id="currentQuestions">
            @forelse ($testData as $test)
                <div class='border-top'>
                    <a href="{{ route('questionDelete',$test->id) }}" class="btn btn-danger mt-2 float-right"
                       data-id="{{ $test->id }}">Delete</a>
                    <button id="" val="{{$test->question}}" class="btn btn-info mt-2 mr-2 float-right open-edit"
                            data-id="{{ $test->id }}">Edit
                    </button>
                    <h4 class="text-dark font-weight-bold">question {{$test->question}}</h4>
                    @if($test->correct_answer==1)
                        <h5 class='ml-2 text-success'>answer 1: {{$test->first_answer}}</h5>
                    @else
                        <h5 class='ml-2 text-muted'>answer 1: {{$test->first_answer}}</h5>
                    @endif
                    @if($test->correct_answer==2)
                        <h5 class='ml-2 text-success'>answer 2: {{$test->second_answer}}</h5>
                    @else
                        <h5 class='ml-2 text-muted'>answer 2: {{$test->second_answer}}</h5>
                    @endif
                    @if($test->question_type=="4_questions")
                        @if($test->correct_answer==3)
                            <h5 class='ml-2 text-success'>answer 3: {{$test->third_answer}}</h5>
                        @else
                            <h5 class='ml-2 text-muted'>answer 3: {{$test->third_answer}}</h5>
                        @endif
                        @if($test->correct_answer==4)
                            <h5 class='ml-2 text-success'>answer 4: {{$test->fourth_answer}}</h5>
                        @else
                            <h5 class='ml-2 text-muted'>answer 4: {{$test->fourth_answer}}</h5>
                        @endif
                    @endif

                </div>
            @empty
                <h3>There aren't any questions yet</h3>
            @endforelse
        </div>


        <li class="list-group-item list-group-item-action list-group-item-danger" id="errorQuestion"></li>
        <li class="list-group-item list-group-item-action list-group-item-danger" id="errorTestType"></li>
        <li class="list-group-item list-group-item-action list-group-item-danger" id="correctAnswer"></li>
        <li class="list-group-item list-group-item-action list-group-item-danger" id="errorAnswer1"></li>
        <li class="list-group-item list-group-item-action list-group-item-danger" id="errorAnswer2"></li>
        <li class="list-group-item list-group-item-action list-group-item-danger" id="errorAnswer3"></li>
        <li class="list-group-item list-group-item-action list-group-item-danger" id="errorAnswer4"></li>
        <!-- add form-->
        <div id="create-question">
            <h1>{{__("create_question")}}</h1>
            <form action="" id="justAForm" enctype="multipart/form-data" method="GET">
                @csrf
                @method("GET")
                <div class="form-group">
                    <label for="testQuestion">{{__("question")}}</label>
                    <input type="text" class="form-control" id="testQuestion" name="testQuestion"
                           placeholder="Enter a question">

                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{__("Yes or No")}}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        {{__("4 questions")}}
                    </label>
                </div>
                <div class="form-group ">
                    <input class="form-check-input testAnswer1" type="radio" name="correctAnswer" id="correctAnswer1">
                    <label for="testAnswer1" class="testAnswer1">{{__("test_answer_1")}}</label>

                    <input type="text" class="form-control testAnswer1" id="testAnswer1" name="testAnswer1"
                           placeholder="Enter a Answer">

                </div>
                <div class="form-group ">
                    <input class="form-check-input testAnswer2" type="radio" name="correctAnswer" id="correctAnswer2">
                    <label for="testAnswer2" class="testAnswer2">{{__("test_answer_2")}}</label>
                    <input type="text" class="form-control testAnswer2" id="testAnswer2" name="testAnswer2"
                           placeholder="Enter a Answer">
                </div>
                <div class="form-group ">
                    <input class="form-check-input testAnswer3" type="radio" name="correctAnswer" id="correctAnswer3">
                    <label for="testAnswer3" class="testAnswer3">{{__("test_answer_3")}}</label>
                    <input type="text" class="form-control testAnswer3" id="testAnswer3" name="testAnswer3"
                           placeholder="Enter a Answer">
                </div>
                <div class="form-group ">
                    <input class="form-check-input testAnswer4" type="radio" name="correctAnswer" id="correctAnswer4">
                    <label for="testAnswer4" class="testAnswer4">{{__("test_answer_4")}}</label>

                    <input type="text" class="form-control testAnswer4" id="testAnswer4" name="testAnswer4"
                           placeholder="Enter a Answer">
                </div>
                <a href="{{ route('home') }}" class="btn-lg btn-info mt-2 float-right">{{__('back')}}</a>
                <button id="btn-add" class="btn btn-success">{{__('create')}}</button>
            </form>
        </div>
        <!-- edit form-->
        <div id="edit-question">
            <h1>{{__("edit")}}</h1>
            <button id="back-to-create" class="btn-lg btn-dark float-right mb-3">back to create</button>
            <form action="" id="editForm" enctype="multipart/form-data" method="GET">
                @csrf
                @method("GET")
                <input type="hidden" name="editId" id="editId">
                <div class="form-group">

                    <label for="testQuestionEdit">{{__("question")}}</label>
                    <input type="text" class="form-control" id="testQuestionEdit" name="testQuestionEdit"
                           placeholder="Enter a question">

                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefaultEdit" id="flexRadioDefault1Edit">
                    <label class="form-check-label" for="flexRadioDefault1Edit">
                        {{__("Yes or No")}}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefaultEdit" id="flexRadioDefault2Edit">
                    <label class="form-check-label" for="flexRadioDefault2Edit">
                        {{__("4 questions")}}
                    </label>
                </div>
                <div class="form-group ">
                    <input class="form-check-input testAnswer1Edit" type="radio" name="correctAnswerEdit"
                           id="correctAnswer1Edit">
                    <label for="testAnswer1Edit" class="testAnswer1Edit">{{__("test_answer_1")}}</label>

                    <input type="text" class="form-control testAnswer1Edit" id="testAnswer1Edit" name="testAnswer1Edit"
                           placeholder="Enter a Answer">

                </div>
                <div class="form-group ">
                    <input class="form-check-input testAnswer2Edit" type="radio" name="correctAnswerEdit"
                           id="correctAnswer2Edit">
                    <label for="testAnswer2Edit" class="testAnswer2Edit">{{__("test_answer_2")}}</label>
                    <input type="text" class="form-control testAnswer2Edit" id="testAnswer2Edit" name="testAnswer2Edit"
                           placeholder="Enter a Answer">
                </div>
                <div class="form-group ">
                    <input class="form-check-input testAnswer3Edit" type="radio" name="correctAnswerEdit"
                           id="correctAnswer3Edit">
                    <label for="testAnswer3Edit" class="testAnswer3Edit">{{__("test_answer_3")}}</label>
                    <input type="text" class="form-control testAnswer3Edit" id="testAnswer3Edit" name="testAnswer3Edit"
                           placeholder="Enter a Answer">
                </div>
                <div class="form-group ">
                    <input class="form-check-input testAnswer4Edit" type="radio" name="correctAnswerEdit"
                           id="correctAnswer4Edit">
                    <label for="testAnswer4Edit" class="testAnswer4Edit">{{__("test_answer_4")}}</label>

                    <input type="text" class="form-control testAnswer4Edit" id="testAnswer4Edit" name="testAnswer4Edit"
                           placeholder="Enter a Answer">
                </div>
                <a href="{{ route('home') }}" class="btn-lg btn-info mt-2 float-right">{{__('back')}}</a>
                <a id="updateButton" class="btn-lg btn-success mt-2 ">{{__('edit')}}</a>
            </form>
        </div>
    </div>
    </body>
    <script>
        var ttoken = "{{csrf_token()}}"
        var currentId ={{$id}}
    </script>
    <script src="{{ asset('js/ajaxFunction/questionAjax.js') }}">

    </script>
    <script src="{{ asset('js/question.js') }}">

    </script>
@endsection

