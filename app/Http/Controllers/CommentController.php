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
        $userId=Auth::user()->id;
        $testId=$request->testId;
        $content=$request->commentArea;
        if($userId!=0 && $testId!=0){
             $commentId=DB::table("comments")->insertGetId(["user_id"=>$userId,"test_id"=>$testId,"contents"=>$content,"created_at"=>NOW()]);
            return response()->json(['commentId' =>$commentId,'contents'=>$content,"created_at"=>NOW()->toDateTimeString()]);
        }
        return response()->json(['success' => 'Contact form submitted successfully']);
       // DB::table('comments')
       //return Comment::store($request);
    }

    public function edit(editCommentRequest $request){

        $commentId=$request->commentId;
        $content=$request->commentArea;
        $comment=Comment::where('user_id','=',Auth::user())->find($commentId);
        if($comment){
        DB::table("comments")->where("id","=",$commentId)->update(["contents"=>$content,"updated_at"=>NOW()]);
        }
        return response()->json(['success' => 'Contact form submitted successfully']);
    }
    public function destroy($id)
    {
        $comment =  Comment::where('user_id','=',Auth::id())
            ->findOrFail($id);
        //anti spammer if
        if ($comment != null) {

            $comment->delete();
        }

        return response()->json(["message"=>"content has been deleted"]);

    }
}
