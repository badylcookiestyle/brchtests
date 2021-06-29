@extends('layouts.app')
@section('content')
    <body>
    <div class="container">
        <h1>Reports</h1>
        <div class="d-block  p-4 ">
            @forelse($reportz as $report)
                <div id="r{{$report->id}}" class=" border-top py-2" >
                    <h1 class="text-break">{{$report->title}}</h1>
                    <h3 class="float-right">{{__($report->action)}}</h3>
                    @if($report->read==1)
                        <button class="btn btn-outline-dark" id="reasonButton" data-id="{{$report->id}}">read</button>
                    @else
                        <button class="btn btn-outline-info" id="reasonButton" data-id="{{$report->id}}">read</button>
                    @endif
                    <a  href="test/{{$report->reported_test}}"class="btn btn-outline-info" id="showButton" data-id="{{$report->id}}">show</a>
                    <button class="btn btn-outline-danger" id="deleteButton" data-id="{{$report->id}}">destroy</button>

                    <div class="description" id="d{{$report->id}}">
                        {{$report->reason}}
                    </div>
                </div>
            @empty
                <h2>Nobody is breaking rules </h2>
            @endforelse
        </div>
    </div>
    </body>
    <script src="{{ asset('js/selectReport.js') }}"></script>
    <script src="{{ asset('js/ajaxFunction/destroyReport.js')}}"></script>

@endsection
