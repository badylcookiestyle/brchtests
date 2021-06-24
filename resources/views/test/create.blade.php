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
    <div  class="border mt-5 p-5 row">
      <div class="col">
		<h1 >{{__("create_test")}}</h1>
			<form  action="{{route("testStore")}}"  enctype="multipart/form-data"  method="POST">
				 @csrf
      @method("POST")

  <div class="form-group ">
    <label for="testTitle">{{__("test_title")}}</label>
    <input type="text" class="form-control" id="testTitle" name="testTitle" placeholder="Enter a title">

  </div>
  <div class="form-group">
    <label for="descriptionTest">{{__('Description')}}</label>
    <textarea class="form-control" id="descriptionTest" name="descriptionTest"  rows="8" maxlength="500" style='resize:none'></textarea>
  </div>

  <div class="form-group">
    <label for="testImg">{{__('Select your img if you want')}}</label>
    <input type="file" class="form-control-file" id="testImg"  name="testImg" accept=".png, .jpg, .jpeg">
  </div>
  <button class="btn btn-success">{{__('create')}}</button>
</form>
</div>
</div>
	</section>
@endsection
