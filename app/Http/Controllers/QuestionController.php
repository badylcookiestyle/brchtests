<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\storeQuestionRequest;
use App\Models\Question;
class QuestionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
    public function create($id){
        $testData=DB::table("questions")->where("test_id","=",$id)->get();
        return view("question.create",["id"=>$id,"testData"=>$testData]);
    }
    public function store(storeQuestionRequest $request){

        DB::table("questions")->insert([
            "created_at"=>now(),
            "updated_at"=>now(),
            "correct_answer"=>$request->correct_answer,
            "test_id"=>$request->testId,
            "question"=>$request->testQuestion,
            "question_type"=>$request-> flexRadioDefault,
            "first_answer"=>$request->testAnswer1,
            "second_answer"=>$request->testAnswer2,
            "third_answer"=>$request->testAnswer3,
            "fourth_answer"=>$request->testAnswer4
        ]);
        $testData=DB::table("questions")->where("test_id","=",$request->testId)->get();
        return response()->json(['success'=>'Contact form submitted successfully','testData'=>$testData] );
    }
}
