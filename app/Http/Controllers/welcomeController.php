<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
class welcomeController extends Controller
{
    public function index(){


        $tests=Test::select("name","id","file_path")->get();
        return view('welcome',["tests"=>$tests]);
    }
}
