<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{

     use HasFactory;
    protected $table = "questions";
    protected $fillable = [

    	"correct_answer",
    	"question",
    	"question_type",
    	"first_answer",
    	"second_answer",
    	"third_answer",
    	"fourth_answer",
    	"test_id"
    ];
    protected $primaryKey = "id";
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $timestamps = true;

    public function index()
    {

    }
    public static function updateStore($request){
        $question_type = $request->flexRadioDefaultEdit;
        if ($question_type == "4_questions") {
            DB::table("questions")->where("id", "=", $request->questionIdEdit)->update([
                "updated_at" => now(),
                "correct_answer" => $request->correct_answerEdit,
                "question" => $request->testQuestionEdit,
                "question_type" => $request->flexRadioDefaultEdit,
                "first_answer" => $request->testAnswer1Edit,
                "second_answer" => $request->testAnswer2Edit,
                "third_answer" => $request->testAnswer3Edit,
                "fourth_answer" => $request->testAnswer4Edit,
            ]);

        } elseif ($question_type == "yes_or_no") {
            DB::table("questions")->where("id", "=", $request->questionIdEdit)->update([
                "updated_at" => now(),
                "correct_answer" => $request->correct_answerEdit,
                "question" => $request->testQuestionEdit,
                "question_type" => $request->flexRadioDefaultEdit,
                "first_answer" => $request->testAnswer1Edit,
                "second_answer" => $request->testAnswer2Edit,
                "third_answer" => "--",
                "fourth_answer" => "--",
            ]);

        }

        $testData = DB::table("questions")->where("test_id", "=", $request->testIdEdit)->get();
        return response()->json(['success' => 'Contact form submitted successfully', 'testData' => $testData]);
    }
    public function create()
    {

    }
    public static function store($request)
    {
        DB::table("questions")->insert([
            "created_at" => now(),
            "updated_at" => now(),
            "correct_answer" => $request->correct_answer,
            "test_id" => $request->testId,
            "question" => $request->testQuestion,
            "question_type" => $request->flexRadioDefault,
            "first_answer" => $request->testAnswer1,
            "second_answer" => $request->testAnswer2,
            "third_answer" => $request->testAnswer3,
            "fourth_answer" => $request->testAnswer4
        ]);
        DB::table("tests")->where("id","=",$request->testId)->increment("max_score");
        $testData = DB::table("questions")->where("test_id", "=", $request->testId)->get();
        return response()->json(['success' => 'Contact form submitted successfully', 'testData' => $testData]);
    }
    public function TestsList()
    {

    }
}
