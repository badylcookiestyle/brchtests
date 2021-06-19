@extends('layouts.app')
@section('content')

	<section class="container">
        <form action="{{route('testCreate')}}" method="GET">
            @csrf
            @method("GET")
            <button class="btn btn-info float-right">{{__('add_new_test')}}</button>
        </form>
		<h1>List of your tests</h1>
		@forelse($tests as $test)
			<div class="  mt-3 border">
				 <form class="float-right" action="/test/{{$test->id}} "method="POST">
            @csrf
            @method('delete')
            <button type="submit"  class="btn btn-danger float-right mt-1 ml-2 mr-2">
              {{__('delete')}}
            </button>
          </form>
          <form class="float-right" action="{{route("questionIndex",['id'=>$test->id])}}">
          	@csrf
          	@method('get')
              <button type="submit"  class="btn btn-info float-right mt-1 ml-2 ">
              {{__('edit')}}
            </button>
          </form>
                <form class="float-right" action="{{route("testIndex",['id'=>$test->id])}}">
                    @csrf
                    @method('get')
                    <button type="submit"  class="btn btn-success float-right mt-1 ml-2 ">
                        {{__('use')}}
                    </button>
                </form>

				<h3 class="ml-3">{{$test->name}}</h3>
				<div class="ml-3">
					<h6 class="text-muted">{{__("date_of_creation ").$test->created_at}}</h6>
					<h6 class="text-muted">{{__("date_of_latest_modification ").$test->updated_at}}</h6>
  				</div>
			</div>
		@empty
			<h4>You don't have any tests :/</h4>
		@endforelse
		<div class="d-inline-flex mt-5">
			{{ $tests->links() }}
		</div>
	</section>
@endsection
