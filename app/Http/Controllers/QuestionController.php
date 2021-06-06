<?php

namespace App\Http\Controllers;

use App\Http\Requests\updateQuestionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\storeQuestionRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function create($id)
    {
        $testData = DB::table("questions")->where("test_id", "=", $id)->get();
        $img = DB::table("tests")->where("id", "=", $id)->select("file_path", "name", "description")->first();

        return view("question.create", ["id" => $id, "testData" => $testData, "description" => $img]);
    }
    public function update(updateQuestionRequest $request){
        $question_type=$request->flexRadioDefaultEdit;
        if($question_type=="4_questions"){
        DB::table("questions")->where("id","=",$request->questionIdEdit)->update([
            "updated_at"=>now(),
            "correct_answer"=>$request->correct_answerEdit,
            "question"=>$request->testQuestionEdit,
            "question_type"=>$request->flexRadioDefaultEdit,
            "first_answer"=>$request->testAnswer1Edit,
            "second_answer"=>$request->testAnswer2Edit,
            "third_answer"=>$request->testAnswer3Edit,
            "fourth_answer"=>$request->testAnswer4Edit,
        ]);

        }
        elseif ($question_type=="yes_or_no"){
            DB::table("questions")->where("id","=",$request->questionIdEdit)->update([
                "updated_at"=>now(),
                "correct_answer"=>$request->correct_answerEdit,
                "question"=>$request->testQuestionEdit,
                "question_type"=>$request->flexRadioDefaultEdit,
                "first_answer"=>$request->testAnswer1Edit,
                "second_answer"=>$request->testAnswer2Edit,
                "third_answer"=>"--",
                "fourth_answer"=>"--",
            ]);

        }

       $testData = DB::table("questions")->where("test_id", "=", $request->testIdEdit)->get();
        return response()->json(['success' => 'Contact form submitted successfully', 'testData' => $testData]);
    }
    public function store(storeQuestionRequest $request)
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
        $testData = DB::table("questions")->where("test_id", "=", $request->testId)->get();
        return response()->json(['success' => 'Contact form submitted successfully', 'testData' => $testData]);
    }

    public function destroy($id)
    {
        Question::find($id)->delete($id);
        return redirect()->back();
    }
}
