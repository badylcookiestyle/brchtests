@extends('layouts.app')

@section('content')
    <div class="container text-center">


            <div class="row">
                @for($i=0;$i<count($tests);$i++)
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            <h1>{{$tests[$i]->name}}</h1>
                        <form action="{{route("testIndex",['id'=>$tests[$i]->id])}}">
                            @csrf
                            @method('get')
            <input type="image" class="img-fluid mb-5" style="max-height: 500px;  position: relative;"

                 src="{{ asset('storage/images/'.$tests[$i]->file_path )}}" alt="There is no img">
                        </form>
                    </div>
                @endfor
            </div>


    </div>
@endsection
