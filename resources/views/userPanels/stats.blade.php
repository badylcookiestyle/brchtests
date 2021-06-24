@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-outline-dark mt-2 float-right">{{__('home')}}</a>
        <h1>Hello! {{Auth::user()->name}}</h1>
        <h1>Your stats</h1>
        <h3>Average score : {{$averageScore}}</h3>
        <h3>Amount of completed tests : {{$amountOfCompleted}}</h3>
    </div>
@endsection
