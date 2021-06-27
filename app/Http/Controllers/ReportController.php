<?php

namespace App\Http\Controllers;
use App\Http\Requests\reportRequest;
use Illuminate\Http\Request;
use App\Models\Report;
class ReportController extends Controller
{
    public function warningOrDelete(reportRequest $request){
        if (auth()->check()) {
            return Report::warningOrDelete($request);
        }
        //here will be displayed error :)
        return response()->json('nice try :)');
    }
    public function index(){
        return Report::index();
    }
    public function read(Request $request){
        return Report::read($request->reportId);
        //return $request;
    }
}
