<?php

namespace App\Http\Controllers;
use App\Models\SubComment;
use Illuminate\Http\Request;
use App\Http\Requests\subCommentRequest;
class SubCommentController extends Controller
{
    public function store(subCommentRequest $request){
        return SubComment::store($request);
    }
    public function get(Request $request){
        return SubComment::get($request);
    }
    public function edit(Request $request){
        return SubComment::edit($request);
    }
    public function destroy($id)
    {
        return SubComment::destroy($id);
    }
}
