<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function index($id){
        return view("question.index")->with("id",$id);
    }
    public function store(Request $request){
        $data=$request->validate([
            "testQuestion"=>"sometimes|min:2|max:64",
            "flexRadioDefault"=>"sometimes",
            "testAnswer1"=>"sometimes|min:2|max:64",
            "testAnswer2"=>"sometimes|min:2|max:64",
            "testAnswer3"=>"sometimes|min:2|max:64",
            "testAnswer4"=>"sometimes|min:2|max:64"
        ]);
        DB::table("questions")->insert([
            "created_at"=>now(),
            "updated_at"=>now(),
            "correct_answer"=>1,
            "test_id"=>$request->testId,
            "question"=>$request->testQuestion,
            "question_type"=>"brch",
            "first_answer"=>$request->testAnswer1,
            "second_answer"=>$request->testAnswer2,
            "third_answer"=>$request->testAnswer3,
            "fourth_answer"=>$request->testAnswer4
        ]);
       return $request;
    }
}
