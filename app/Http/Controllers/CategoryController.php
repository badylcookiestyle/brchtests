<?php

namespace App\Http\Controllers;
use App\Http\Requests\categoryRequest;
use App\Models\Test;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function categoryFilter(categoryRequest $request){
   
        if($request->text==null || $request->text==""){
        return Test::where("category",$request->category)->get();
        }
     
        return Test::where("category",$request->category)->where("name","like",$request->text.'%')->get();
        
    }
}
