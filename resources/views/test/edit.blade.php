@extends('layouts.app')
@section('content')
 @if($errors->any())
      <div class="w-4/8 m-auto text-center">
          @foreach($errors->all() as $error)
            <li  class="list-group-item list-group-item-action list-group-item-danger">{{$error}}</li>
        @endforeach
      </div>
  @endif
	<section class="container text-center">

    <img class="img-fluid" style="max-height: 500px;  position: relative;" src="{{ asset('storage/images/'.$test->file_path )}}"   alt="There is no img">
   <div class="caption" style="position: absolute;
    top: 25%;
    left: 0;
    width: 100%;">
             <h1 class="text-light" >{{__("edit_test")}}</h1>
        </div>
		

			<form class="border mt-5 p-5"  enctype='multipart/form-data' method="POST">
				 @csrf
      @method("POST")

  <div class="form-group ">
    <label for="testTitle">{{__("current_title")}}</label>
    <input type="text" class="form-control" id="testTitle" name="testTitle" value="{{$test->name}}"placeholder="Enter a title">
    
  </div>
  <div class="form-group">
    <label for="descriptionTest">{{__('current_description')}}</label>
    <textarea class="form-control" id="descriptionTest" name="descriptionTest"  rows="8" maxlength="500" style='resize:none'   >{{$test->description}}</textarea>
  </div>
   
  <div class="form-group">
    <label for="testImg">{{__('choose_new_img')}}</label>
    <input type="file" class="form-control-file" id="testImg"  name="testImg" accept=".png, .jpg, .jpeg">
  </div>
  <button class="btn btn-success">{{__('create')}}</button>
</form>


	</section> 
@endsection