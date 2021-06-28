<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Test;
use App\Models\Report;

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
        DB::table("reports")->where("reported_test",$request->testId)->where("action","reportOnly")->delete();
        }
        if(Auth::User()->isAdmin()){
        Report::insert([
            "title"=>$request->title,
            "reason"=>$request->description,
            "action"=>$request->action,
            "reporting_user_id"=>Auth::user()->id,
            "reported_test"=>$request->testId,
            "user_id"=>$userId

        ]);
        }
        else{
            Report::insert([
                "title"=>$request->title,
                "reason"=>$request->description,
                "action"=>"reportOnly",
                "reporting_user_id"=>Auth::user()->id,
                "reported_test"=>$request->testId,
                "user_id"=>$userId]);
        }
            return response()->json('everythin is workin');
        }
    }
    public static function index(){
        $reportz=DB::table("reports")
            ->join("users","reports.user_id","=","users.id")
            ->where("user_id","=",Auth::id())
            ->where("action","!=","reportOnly")
            ->select("title","reason","action","name","reports.id","read")
            ->OrderBy("id",'desc')
            ->get();
        return view("userPanels.reports",["reportz"=>$reportz]);
    }
    public static function read($id){
        $CheckIfReportExist=DB::table("reports")
            ->where("id",$id)
            ->where("user_id",Auth::id())
            ->get();

        if($CheckIfReportExist!==null){
            DB::table("reports")->where("id",$id)->update(['read'=>true]);
        }
    }
    public static function reportsList(){
        $reportz=DB::table("reports")
            ->where("action","=","reportOnly")
            ->orderBy("id","desc")
            ->get();
        return view("adminPanels.reports")->with("reportz",$reportz);
    }
    public static function destroy($id){
        $report = Report::find($id);
        $report->delete();
        return response()->json(['success' => 'everythin is ok']);
    }
    public function report()
    {
        return $this->belongsTo(User::class);
    }
}
