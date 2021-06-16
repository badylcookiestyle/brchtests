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

    public function update(updateQuestionRequest $request)
    {
        return Question::updateStore($request);
    }

    public function store(storeQuestionRequest $request)
    {
        return Question::store($request);
    }

    public function destroy($id)
    {
        Question::find($id)->delete($id);
        return redirect()->back();
    }
}
