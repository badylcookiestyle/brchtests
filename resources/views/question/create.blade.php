 @extends('layouts.app')
@section('content')
<body>
  <div class="container">
  <h1>{{__("create_question")}}</h1>
   <form action="" enctype="multipart/form-data" method="POST">
        @csrf

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
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
              {{__("4 questions")}}
            </label>
        </div>
        <div class="form-group ">
          <label for="testAnswer1" class="testAnswer1">{{__("test_answer_1")}}</label>
          <input type="text" class="form-control testAnswer1" id="testAnswer1" name="testAnswer1" placeholder="Enter a Answer">
        </div>
        <div class="form-group ">
          <label for="testAnswer2" class="testAnswer2">{{__("test_answer_2")}}</label>
          <input type="text" class="form-control testAnswer2" id="testAnswer2"  name="testAnswer2" placeholder="Enter a Answer">
        </div>
        <div class="form-group ">
          <label for="testAnswer3" class="testAnswer3">{{__("test_answer_3")}}</label>
          <input type="text" class="form-control testAnswer3" id="testAnswer3" name="testAnswer3 " placeholder="Enter a Answer">
        </div>
        <div class="form-group ">
          <label for="testAnswer4" class="testAnswer4">{{__("test_answer_4")}}</label>
          <input type="text" class="form-control testAnswer4" id="testAnswer4" name="testAnswer4" placeholder="Enter a Answer">
        </div>
        <button id="btn-add"class="btn btn-success">{{__('create')}}</button>
        </form>
      </div>
    </body>
    <script  >
      var currentId={{$id}}
       function reset(){
     $(".testAnswer1").hide()
  $(".testAnswer2").hide()
  $(".testAnswer3").hide()
  $(".testAnswer4").hide()
  }
  reset()
  $( "#flexRadioDefault1" ).click(function() {
    reset()
    $(".testAnswer1").show()
    $(".testAnswer2").show()
});
  $( "#flexRadioDefault2" ).click(function() {
    reset()
    $(".testAnswer1").show()
    $(".testAnswer2").show()
    $(".testAnswer3").show()
    $(".testAnswer4").show()
});
  jQuery(document).ready(function($){


    // CREATE
    $("#btn-add").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
             testId: {{$id}},
             testQuestion: jQuery('#testQuestion').val(),
             flexRadioDefault: jQuery('.flexRadioDefault').val(),
             testAnswer1:jQuery('#testAnswer1').val(),
             testAnswer2:jQuery('#testAnswer2').val(),
             testAnswer3:jQuery('#testAnswer3').val(),
             testAnswer4:jQuery('#testAnswer4').val(),
        };
        var state = jQuery('#btn-add').val();
        var type = "POST";

        var ajaxurl = 'question';
        $.ajax({
            type: type,
            url: "{{ url('question')}}",
            data: formData,
            dataType: 'json',
            success: function (data) {

                jQuery('#myForm').trigger("reset");
                jQuery('#formModal').modal('hide')
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});

  </script>
@endsection
