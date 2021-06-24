<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\StorageFileController;
use App\Models\Comment;

class Test extends Model
{
    use HasFactory;

    protected $table = "tests";
    protected $fillable = ["name", "description", "file_path", "id_u"];
    protected $primaryKey = "id";

    public function user()
    {
        return $this->belongsTo(User::class)->hasMany(Comment::class);
    }
    public $timestamps = true;
    public static function index($id)
    {
        $userId = 0;
        if (Auth::check()) {
            $userId = Auth::user()->id;
        }
        $questions = Question::where("test_id", "=", $id)->get();
        $testData = Test::where("id", "=", $id)->select("description", "file_path", "name", "user_id")->first();
        $comments = Comment::where("test_id", '=', $id)->orderBy("created_at", "desc")->get();
        $likesTest = DB::table("test_likes")->where("test_id", "=", $id)->count();

        $likesComments=DB::select('select comments.id,count(comment_likes.id) as result from comment_likes right join comments ON comment_likes.comment_id=comments.id where test_id=1 GROUP BY comments.id  ORDER BY comments.id DESC');
        $likes=json_encode(["likesTest"=>$likesTest,"likesComment"=>$likesComments]);
        $isLiked = DB::table("test_likes")->where("test_id", "=", $id)->where("user_id", "=", $userId)->count();
        if (count($questions) > 0) {
            if ($userId == $testData->user_id) {
                return view("test.index", ['testData' => $testData, 'questions' => $questions, 'comments' => $comments, "canEdit" => true, "likes" => $likes, "isLiked" => $isLiked]);
            } else {
                return view("test.index", ['testData' => $testData, 'questions' => $questions, 'comments' => $comments, "canEdit" => false, "likes"=>$likes, "isLiked" => $isLiked]);
            }
        } else {
            if (Auth::check()) {
                return redirect()->route("questionIndex", ['id' => $id]);
            } else {
                return redirect()->route("notWorking");
            }
        }
    }

    public function create()
    {

    }

    public static function store($request)
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

    public function TestsList()
    {

    }

    public static function checkAnswers($request)
    {
        $score = 0;
        $invalidAnswers = array();
        $answers = $request->answers;
        $correctAnswers = Question::where("test_id", "=", $request->testId)->select("correct_answer", "question")->get();
        Test::where("id", "=", $request->testId)->increment("amount_of_solutions");
        $correctAnswers->toArray();
        for ($i = 0; $i < count($request->answers); $i++) {
            if ($answers[$i] == $correctAnswers[$i]->correct_answer) {
                $score++;
            } else {
                array_push($invalidAnswers, $correctAnswers[$i]->question);
            }
        }
        return array('score' => $score, 'invalidAnswers' => $invalidAnswers);
    }

    public static function changeImg($request)
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
}

