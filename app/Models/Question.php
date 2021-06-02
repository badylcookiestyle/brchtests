<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function create()
    {

    }
    public function store(Request $request)
    {
    }
    public function TestsList()
    {

    }
}
