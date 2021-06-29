@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1 class="mb-5">{{__("settings")}}</h1>
        <form action="{{route("changePasswordPanel")}}" method="GET">
            @csrf
            @method("GET")
            <button class="btn btn-info mb-5">{{__("change password")}}</button><br>
        </form>
        <form action=" {{route("deleteAccountPanel")}}" method="GET">
            @csrf
            @method("GET")
            <button class="btn btn-info mb-5">{{__("delete account")}}</button><br>
        </form>
    </div>
@endsection
