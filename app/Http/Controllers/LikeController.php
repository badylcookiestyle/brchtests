<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
class LikeController extends Controller
{

    public function testLike(Request $request){
        $userId = Auth::user()->id;
        $testId=$request->testId;

        $ifTestExist=Test::find($testId);
        if($ifTestExist){
            $isLiked=DB::table('test_likes')->where("user_id","=",$userId)->where("test_id","=",$testId)->first();
            if($isLiked){
                DB::table('test_likes')->where("user_id","=",$userId)->where("test_id","=",$testId)->delete();
                return response()->json(["success"=>"decrement"]);
            }
            else{
                DB::table('test_likes')->insert(['user_id'=>$userId,'test_id'=>$testId,'created_at'=>NOW()]);
                return response()->json(["success"=>"increment"]);
            }
        }
    }
    public function commentLike(Request $request){
        //return $request;
        $userId = Auth::user()->id;
        $commentId=$request->commentId;
        $ifCommentExist=Comment::find($commentId);
        if($ifCommentExist){
            $isLiked=DB::table('comment_likes')->where("user_id",'=',$userId)->where("comment_id","=",$commentId)->first();
            if($isLiked){
                DB::table("comment_likes")->where("user_id","=",$userId)->where("comment_id","=",$commentId)->delete();
                return response()->json(["success"=>"decrement"]);
            }
            else{
                DB::table('comment_likes')->insert(['user_id'=>$userId,'comment_id'=>$commentId,'created_at'=>NOW()]);
                return response()->json(["success"=>"increment","commentId"=>$commentId]);
            }

        }

    }
}
