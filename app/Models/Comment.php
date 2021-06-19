<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;
    public function comment()
    {
        return $this->belongsTo(User::class)->belongsTo(Test::class)->hasMany(SubComment::class);
    }
    public static function store($request){
        $userId=Auth::user()->id;
        $testId=$request->testId;
        $content=$request->commentArea;
        if($userId!=0 && $testId!=0){
            $commentId=DB::table("comments")->insertGetId(["user_id"=>$userId,"test_id"=>$testId,"contents"=>$content,"created_at"=>NOW()]);
            return response()->json(['commentId' =>$commentId,'contents'=>$content,"created_at"=>NOW()->toDateTimeString()]);
        }
        return response()->json(['success' => 'Contact form submitted successfully']);
    }
    public static function edit($request){
        $commentId=$request->commentId;
        $content=$request->commentArea;
        $comment=Comment::where('user_id','=',Auth::user())->find($commentId);
        if($comment){
            DB::table("comments")->where("id","=",$commentId)->update(["contents"=>$content,"updated_at"=>NOW()]);
        }
        return response()->json(['success' => 'Contact form submitted successfully']);
    }
    public static function destroy($id)
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
