@extends('layouts.app')
@section('content')
    @php
        use App\Models\Comment;
        use App\Models\SubComment;
    @endphp
    <section class="container">
        @if(Auth::check())
            <form class="float-right" action="{{route('home')}}">
                @csrf
                @method('get')
                <button type="submit" class="btn btn-dark float-right mt-1 ml-2 ">
                    {{__('home')}}
                </button>
            </form>
            @if($canEdit==true)
                <form class="float-right" action="{{route('questionIndex',["id"=>$questions[0]->test_id])}}">
                    @csrf
                    @method('get')
                    <button type="submit" class="btn btn-info float-right mt-1 ml-2 ">
                        {{__('edit')}}
                    </button>
                </form>
            @endif
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
                        <input class="form-check-input" type="radio" name="questionRadios{{$counter}}"
                               id="exampleRadios1"
                               value="1">

                        <label class="form-check-label" for="questionRadios{{$counter}}">
                            {{$question->first_answer}}
                        </label><br>
                        <input class="form-check-input" type="radio" name="questionRadios{{$counter}}"
                               id="exampleRadios2"
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
            <section class="comments">
                <hr style="width: 100%; color: text-secondary; height: 1px; background-color:text-secondary;">
                <ul>
                    <li class="list-group-item list-group-item-action list-group-item-danger"
                        id="errorComment"></li>
                </ul>
                <div id="addComment">
                    <form method="POST" id="commentForm">
                        @csrf
                        @method("POST")
                        <div class="form-group d-flex">
                            <label for="commentArea" class="m-2">comment</label>
                            <textarea class="form-control m-2" id="commentArea" rows="3"></textarea>


                    </form>
                </div>
                <button id="sendForm" class="btn btn-dark m-2" style="height:50px;">send</button>
        </div>
        <!--Edit comment-->
        <div id="editComment">
            <form method="POST" id="editCommentForm">
                @csrf
                @method("POST")
                <div class="form-group d-flex">
                    <label for="editCommentArea" class="m-2">edit comment</label>
                    <textarea class="form-control m-2" id="editCommentArea" rows="3"></textarea>
            </form>
        </div>
        <button id="sendEditForm" class="btn btn-dark m-2" style="height:50px;">edit</button>
            <button id="commentBack" class="btn btn-info ml-2" style="height:50px;">back</button>
        </div>
        <hr>
        <div id="comments-list">
            @foreach($comments as $comment)
                <div id="c{{$comment->id}}">
                    <h3>{{$comment->contents}}</h3>
                    <h6>{{$comment->created_at}}</h6>
                    @if(Auth::check())
                        @if(null!==Comment::where('user_id','=',Auth::id())->find($comment->id))
                            <button class="btn btn-sm btn-outline-info py-0" style="font-size: 0.8em;"
                                    id="editCommentButton" value="{{$comment->contents}}" data-id="{{ $comment->id }}">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;"
                                    id="deleteComment" data-id="{{ $comment->id }}">
                                Delete
                            </button>

                            @endif
                            <button class="btn btn-sm btn-outline-dark py-0" style="font-size: 0.8em;"
                                    id="replyButton" value="{{$comment->contents}}" data-id="{{ $comment->id }}">
                                Reply
                            </button>
                            <br>

                    @endif
                    <button id="expandReplies" class="btn btn-toolbar" data-id="{{ $comment->id }}">replies</button>
                </div>
            @endforeach
        </div>
    </section>
    </div>
    </section>

    <script>
        $("#score-section").toggle()
        var testId = {{$testId}};
        var counter = -1 + {{$counter}};
        var answers = [];</script>
    <script src="{{asset('js/comments.js')}}"></script>
    <script src="{{ asset('js/getAnswers.js') }}"></script>

@endsection
