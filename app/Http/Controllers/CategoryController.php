<?php

namespace App\Http\Controllers;
use App\Http\Requests\categoryRequest;
use App\Models\Test;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryFilter(categoryRequest $request){
        return Test::where("category",$request->category)->get();
    }
}
