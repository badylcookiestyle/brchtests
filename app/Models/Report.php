<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Test;

class Report extends Model
{
    use HasFactory;
    protected $table = "reports";
    protected $fillable = [

        "title",
        "reason"
    ];
    protected $primaryKey = "id";
    public static function warningOrDelete($request){
        //user_id=reported user
        $testData=DB::table("tests")->where("id","=",$request->testId)->first();

        if($testData!==null){
        $userId=$testData->user_id;
        if($request->action=="warningWithDelete"){
        Test::destroy($request->testId);
        }
        Report::insert([
            "title"=>$request->title,
            "reason"=>$request->description,
            "action"=>$request->action,
            "reporting_user_id"=>Auth::user()->id,
            "user_id"=>$userId

        ]);
            return response()->json('everythin is workin');
        }
    }
    public function report()
    {
        return $this->belongsTo(User::class);
    }
}
