<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\createTestRequest;
use App\Http\Controllers\StorageFileController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Test;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $questions=Question::where("test_id","=",$id)->get();
        $testData=Test::where("id","=",$id)->select("description","file_path","name")->first();
        return  view("test.index",['testData'=>$testData,'questions'=>$questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("test.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(createTestRequest $request)
    {


        $test = new Test;
        if ($request->file('testImg') != "") {
            $uploadedFile = $request->file('testImg');
            $filename = time() . $uploadedFile->getClientOriginalName();
            $test->file_path = $filename;
            Storage::disk('local')->putFileAs('public/' . "images/", $uploadedFile, $filename);

        }

        $test->name = $request->testTitle;
        $test->description = $request->descriptionTest;

        $test->amount_of_solutions = 0;
        $test->user_id = Auth::id();
        $test->save();
        return redirect()->route("questionIndex", ["id" => $test->id, "img" => $test->file_path]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = Test::find($id);
        return view("test.edit", ["test" => $test]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function checkAnswers(Request $request){
        $score=0;
        $invalidAnswers=array();
        $answers=$request->answers;
        $correctAnswers=Question::where("test_id","=",$request->testId)->select("correct_answer","question")->get();
        Test::where("id","=",$request->testId)->increment("amount_of_solutions");
        $correctAnswers->toArray();
        for($i=0;$i<count($request->answers);$i++){
            if($answers[$i]==$correctAnswers[$i]->correct_answer){
                $score++;
            }
            else{
                array_push($invalidAnswers,$correctAnswers[$i]->question);
            }
        }
        return array('score'=>$score,'invalidAnswers'=>$invalidAnswers);
    }

    public function changeImg(Request $request)
    {

        $request->validate([
            'file' => "required|image|mimes:jpg,png,jpeg|max:4048|dimensions:max_width=100,max_height=200|dimensions:ratio=3/2",
        ]);


        if ($request->file('file')) {
            $uploadedFile = $request->file('file');
            $imagePath = $request->file('file');
            $imageName = time() . $imagePath->getClientOriginalName();
            Storage::disk('local')->putFileAs('public/' . "images/", $uploadedFile, $imageName);
            $oldFile = Test::where("id", "=", $request->testId)->select("file_path")->first();
            Storage::disk('local')->delete('public/images/' . $oldFile->file_path);
            Test::where("id", "=", $request->testId)->update(["file_path" => $imageName]);

        }

        return response()->json('Image uploaded successfull');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = Test::find($id);
        //anti spammer if
        if ($test != null) {
            $oldFile = Test::where("id", "=", $id)->select("file_path")->first();
            Storage::disk('local')->delete('public/images/' . $oldFile->file_path);
            $test->delete();
        }

        return redirect("/home");
    }
}
