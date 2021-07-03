@extends('layouts.app')

@section('content')
    
    <div class="container text-center">
            <div class="row">
             
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
           
                      
                           
                        <input type="image" class="img-fluid mb-5" style="max-height: 500px;  position: relative;"
                 src="{{asset('logo.jpg')}}" alt="There is no img">
                       
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0 text-justify">
                        <h1 class="mb-4">{{__('contact')}}</h1>
                        <h3>mail : somethin@gmail.com</h3>
                        <h3>phone number : 000 000 000</h3>
                        <h3>linkedin : </h3>
                    </div>
               
            </div>
    </div>
     
@endsection
