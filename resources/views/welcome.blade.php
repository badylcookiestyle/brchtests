@extends('layouts.app')

@section('content')
    <body>
        <nav class="navbar navbar-light bg-light mx-5">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Filters</span>
                <select class="form-select form-select-lg" id="category" name="category" aria-label=".form-select-lg example">
                    <option selected>Select category</option>
                    <option value="fitness">fitness</option>
                    <option value="video games">video games</option>
                    <option value="anime">anime</option>
                    <option value="science">science</option>
                    <option value="cooking">cooking</option>
                    <option value="history">history</option>
                    <option value="other">other</option>
                </select>
                <select class="form-select form-select-lg" id="sort" name="sort" aria-label=".form-select-lg example">
                    <option selected data-order="ASC">Sort</option>
                    <option value="created_at" data-order="DESC">newest</option>
                    <option value="created_at" data-order="ASC">oldest</option>
                    <option value="amount_of_solutions" data-order="DESC">most popular</option>
                    <option value="amount_of_solutions" data-order="ASC">less popular</option>
                    <option value="average_score" data-order="DESC">average score d</option>
                    <option value="average_score" data-order="ASC">average score a</option>
                  
                </select>
                <button class="btn btn-dark" id="filter-button">filter</button>
            </div>
        </nav>
    <div class="container text-center">
       
            <div class="row" id="searchResultArea">
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
    </body>
    <script src="{{asset('js/filters/filters.js')}}"></script>
@endsection
