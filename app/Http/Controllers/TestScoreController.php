<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestScore;
class TestScoreController extends Controller
{
    public function index($id){
        return TestScore::index($id);
    }
}
