@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1 class="mb-5">{{__("settingsH1")}}</h1>

        <form action=" " method="GET">
            @csrf
            @method("GET")
            <button class="btn btn-info mb-5">{{__("change password")}}</button><br>
        </form>
        <form action=" " method="GET">
            @csrf
            @method("GET")
            <button class="btn btn-info mb-5">{{__("delete account")}}</button><br>
        </form>

    </div>
@endsection
