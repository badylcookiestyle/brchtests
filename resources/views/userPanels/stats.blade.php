@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-outline-dark mt-2 float-right">{{__('home')}}</a>
        <h1>Hello! {{Auth::user()->name}}</h1>
        <h1>Your stats</h1>
        @if($amountOfCompleted!=0)
        <h3>Average score : {{$averageScore}}</h3>
        <h3>Amount of completed tests : {{$amountOfCompleted}}</h3>
            <h3>Sum of correct answers : {{$sumOfCorrect}}</h3>
            <h3>Sum of incorrect answers : {{$sumOfIncorrect}}</h3>
        @else
            <h2>You haven't solved any test yet</h2>
        @endif
    </div>
@endsection
