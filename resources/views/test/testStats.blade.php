@extends('layouts.app')
@section('content')
<div class="container">
    <form class="float-right" action="{{route("questionIndex",['id'=>$id])}}">
        @csrf
        @method('get')
        <button type="submit"  class="btn btn-outline-dark float-right mt-1 ml-2 ">
            {{__('edit')}}
        </button>
    </form>
    <form class="float-right" action="{{route("testIndex",['id'=>$id])}}">
        @csrf
        @method('get')
        <button type="submit"  class="btn btn-outline-success float-right mt-1 ml-2 ">
            {{__('use')}}
        </button>
    </form>
    <h1>Stats</h1>
    <h3>Average score : {{$averageScore}}</h3>
    <h3>Amount of completed tests : {{$amountOfCompleted}}</h3>
</div>
@endsection
