@extends('layouts.app')

@section('content')
    <h1 class="text-center">{{__('contact')}}</h1>
    <section class='container mt-5'>
        <div class='contact' style='float:left;'>
            <img src="{{asset('logo.jpg')}}" class='logo'>
        </div>
        <div class='data ml-5' style='float:left;margin-top:3em;'>
            <h1>Mateusz Morawski</h1>
            <br>
            <h2>badylcookiestyle@gmail.com</h2>
            <br>
            <h2>{{__("phone number")}} 000 000 000</h2>
        </div>
    </section>
@endsection
