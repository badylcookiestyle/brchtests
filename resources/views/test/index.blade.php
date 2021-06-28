@extends('layouts.app')
@section('content')
    @php
        use App\Models\Comment;
        use App\Models\SubComment;
        $j=0;
    @endphp
    @php
        $brch=json_decode($likes);



    @endphp
    <!--Admins Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="warningType" id="warningOnly" value="warningOnly1">
                        <label class="form-check-label" for="warningOnly">{{__("warningOnly")}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="warningType" id="warningWithDelete" value="warningOnlyDelete">
                        <label class="form-check-label" for="warningOnlyDelete">{{__("warningOnlyDelete")}}</label>
                    </div>

                </div>
                <div class="modal-body">
                    <div class="form-group ">
                        <label for="reportOrWarningTitle">test_title</label>
                        <input type="text" class="form-control" id="reportOrWarningTitle" name="reportOrWarningTitle" placeholder="Enter a report">

                    </div>
                    <div class="form-group">
                        <label for="reportOrWarningDescription">Description</label>
                        <textarea class="form-control" id="reportOrWarningDescription" name="reportOrWarningDescription" rows="8" maxlength="500" style="resize:none"></textarea>
                    </div>
                    <button   id="AdminWarningButton" class="btn btn-danger m-3 float-right">Send</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Users Modal -->
    <div class="modal fade" id="modalReport" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                <h1>So u can report this user</h1>
                </div>
                <div class="modal-body">
                    <div class="form-group ">
                        <label for="reportTitle">test_title</label>
                        <input type="text" class="form-control" id="reportTitle" name="reportTitle" placeholder="Enter a report">

                    </div>
                    <div class="form-group">
                        <label for="reportDescription">Description</label>
                        <textarea class="form-control" id="reportDescription" name="reportDescription" rows="8" maxlength="500" style="resize:none"></textarea>
                    </div>
                    <button   id="reportButton" class="btn btn-danger m-3 float-right">Send</button>
                </div>

            </div>
        </div>
    </div>
    <section class="container">


        @if(Auth::check())
            @if(Auth::User()->isAdmin())


                    <button type="submit" data-toggle="modal" class="btn btn-outline-danger float-right mt-1 ml-2 "data-target="#modal">
                        {{__('warning/delete')}}
                    </button>
            @else
                <button type="submit" data-toggle="modal" class="btn btn-outline-danger float-right mt-1 ml-2 "data-target="#modalReport">
                    {{__('report')}}
                </button>
            @endif
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
            <div>
                @if($isLiked==0)
                    <button id="likeButton" class="btn btn-outline-dark ">
                        @else
                            <button id="likeButton" class="btn btn-outline-danger ">
                                @endif
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-heart" viewBox="0 0 16 16">
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                </svg>
                                @php

                                @endphp
                            </button><span class="ml-3" id="likeAmount" style="font-size:1.2em;">{{json_decode($likes)->likesTest}}</span></div>
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

                            <button id="commentLikeButton" class="btn btn-outline-dark lk{{$comment->id}}" data-id="{{ $comment->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-heart" viewBox="0 0 16 16">
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                </svg>
                            </button>


                        @if($brch->likesComment[$j]->result!==null)
                            <span class="ml-3 lkt{{$comment->id}}" id="commentLikeAmount{{$comment->id}}"  style="font-size:1.2em;">{{$brch->likesComment[$j]->result}}</span>
                            @else
                                <span class="ml-3 lkt{{$comment->id}}" id="commentLikeAmount{{$comment->id}}"  style="font-size:1.2em;">0</span>
                            @endif
                        <br>


                    <div class="row">
                        @if(isset($ifSubComments[$j]) &&$ifSubComments[$j]->amountOfSubc!=0)
                    <button id="expandReplies" class="btn btn-toolbar" data-id="{{ $comment->id }}">replies</button><p class="mt-2" id="p{{$comment->id}}">{{$ifSubComments[$j]->amountOfSubc}}</p>
                   @endif
                    </div>
                    @endif
                    </div>
                @php
                $j++
                    @endphp
            @endforeach
        </div>

    </section>
    </div>
    </section>
    <script>
        $("#score-section").toggle()
        @if(Auth::check())
        var userId = {{ Auth::user()->id}};
        @else
        var userId = 0
        @endif
        var testId = {{$testId}};
        var counter = -1 + {{$counter}};
        var answers = [];</script>
    <script src="{{asset('js/ajaxFunction/adminsReport.js')}}"></script>
    <script src="{{asset('js/ajaxFunction/like.js')}}"></script>
    <script src="{{asset('js/ajaxFunction/commentAjax.js')}}"></script>
    <script src="{{asset('js/comments.js')}}"></script>
    <script src="{{ asset('js/getAnswers.js') }}"></script>
@endsection
