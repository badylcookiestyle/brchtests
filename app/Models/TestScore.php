<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestScore extends Model
{
    use HasFactory;

    protected $table = "tests_scores";
    protected $fillable = ["score","user_id","test_id"];
    protected $primaryKey = "id";
    public $timestamps = true;

    public function TestScore()
    {
        return $this->belongsTo(Test::class);
    }
    public static function index($id){
        $score=0;
        $averageScore=0;
        $scores=TestScore::where("test_id","=",$id)->select("score")->get();
        for($i=0;$i<count($scores);$i++){
            $score+=$scores[$i]->score;
        }
        if($score>0){
            $averageScore=round($score/count($scores),2);
        }
        $amountOfCompleted=TestScore::where("test_id","=",$id)->count();
        return view("test.testStats",["amountOfCompleted"=>$amountOfCompleted,"averageScore"=>$averageScore,"id"=>$id]);
    }
}
