<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
       $UsersTests=Test::where("user_id","=",Auth::id())->orderBy("created_at","DESC")->paginate(5);
         
        return view("test.list",["tests"=>$UsersTests]);
    }
}
