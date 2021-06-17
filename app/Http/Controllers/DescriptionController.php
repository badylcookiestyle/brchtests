<?php

namespace App\Http\Controllers;

use App\Http\Requests\changeTestDescription;
use Illuminate\Http\Request;
use App\Models\Test;
class DescriptionController extends Controller
{
    public function __invoke(Request $request)
    {
        //
    }
    public function change(changeTestDescription $request){
        Test::where("id","=",$request->testId)->update(["description"=>$request->descriptionTest]);
        return response()->json(['success' => 'Contact form submitted successfully']);
    }
}
