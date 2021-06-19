<?php

namespace App\Http\Controllers;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\commentRequest;
use App\Http\Requests\editCommentRequest;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    public function store(commentRequest $request){
        return Comment::store($request);
    }

    public function edit(editCommentRequest $request){
        return Comment::edit($request);
    }
    public function destroy($id)
    {
         return Comment::destroy($id);
    }
}
