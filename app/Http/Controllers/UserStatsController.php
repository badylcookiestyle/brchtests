<?php

namespace App\Http\Controllers;
use App\Models\UserStats;
use Illuminate\Http\Request;

class UserStatsController extends Controller
{
    public function index(){
        return UserStats::index();
    }
}
