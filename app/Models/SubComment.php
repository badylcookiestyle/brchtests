<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubComment extends Model
{
    use HasFactory;
    public static function store($request){
        $userId=Auth::user()->id;
        $commentId=$request->commentId;
        $content=$request->commentArea;
        if($userId!=0 && $commentId!=0){
            $subCommentId=DB::table("sub_comments")->insertGetId(["user_id"=>$userId,"comment_id"=>$commentId,"contents"=>$content,"created_at"=>NOW()]);
            return response()->json(['commentId' =>$subCommentId,'contents'=>$content,"created_at"=>NOW()->toDateTimeString()]);
        }
        return response()->json(['success' => 'Contact form submitted successfully']);
    }
    public static function get($request){
        $commentId=$request->commentId;
        $subComments=DB::table("sub_comments")->where("comment_id","=",$commentId)->get();
        return response()->json(['subComments'=> $subComments]);
    }
    public static function edit($request){
        $commentId=$request->id;
        $content=$request->commentArea;
        $comment=SubComment::where('user_id','=',Auth::id())->find($commentId);
        if($comment){
            DB::table("sub_comments")->where("id","=",$commentId)->update(["contents"=>$content,"updated_at"=>NOW()]);
        }
        return response()->json(["message"=>"content has been deleted"]);
    }
    public static function destroy($id)
    {
        $subComment =  SubComment::where('user_id','=',Auth::id())
            ->findOrFail($id);
        //anti spammer if
        if ($subComment != null) {
            $subComment->delete();
        }
        return response()->json(["message"=>"content has been deleted"]);
    }
}
