<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TestScore;
class UserStats extends Model
{
    use HasFactory;
    public static function index(){
        $score=0;
        $averageScore=0;
        $scores=TestScore::where("user_id","=",Auth::id())->select("score")->get();
        for($i=0;$i<count($scores);$i++){
            $score+=$scores[$i]->score;
        }
        $sumOfCorrect=TestScore::where("user_id","=",Auth::id())->sum("correct_answers");
        $sumOfIncorrect=TestScore::where("user_id","=",Auth::id())->sum("incorrect_answers");
        if(count($scores)>0){
        $averageScore=round($score/count($scores),2);}
        $amountOfCompleted=TestScore::where("user_id","=",Auth::id())->count();
        return view("userPanels.stats",["amountOfCompleted"=>$amountOfCompleted,"averageScore"=>$averageScore,"sumOfCorrect"=>$sumOfCorrect,"sumOfIncorrect"=>$sumOfIncorrect]);
    }
}
