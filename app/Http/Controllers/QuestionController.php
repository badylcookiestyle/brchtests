<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\updateQuestionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\storeQuestionRequest;
use App\Models\Question;
use App\Models\Test;
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
        $userId=Auth::user()->id;
        $ifItsUsersTest=Test::where("id","=",$id)
            ->where("user_id","=",$userId)
            ->get();
        if(count($ifItsUsersTest)>0){
            $testData = DB::table("questions")
                ->where("test_id", "=", $id)
                ->get();
            $img = DB::table("tests")
                ->where("id", "=", $id)
                ->select("file_path", "name", "description")
                ->first();
            return view("question.create", ["id" => $id, "testData" => $testData, "description" => $img]);
    }
        return    redirect()->route("notWorking");
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
        //DB::table("tests")->where("id","=",$request->testId)->increment("max_score");
        Test::join("questions","tests.id","=","questions.test_id")->where("questions.id","=",$id)->decrement("max_score");
        Question::find($id)->delete($id);
        return redirect()->back();
    }
}
