<?php

namespace App\Http\Controllers;
use App\Rules\passwordValidationRule;
use App\Http\Requests\changePasswordRequest;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function change(){
        return view("settingsPanels.index");
    }
    public function update(changePasswordRequest $request){
        $currentUser = auth()->user();
        $oldPassword = $request->input("oldPassword");
        $newPassword = $request->input("newPassword");
        $p = strcmp($oldPassword, $newPassword);
        $validate = $request->validated();
        if ($validate) {
            $currentUser->update([
                "password" => bcrypt($request->input("newPassword")),
            ]);

            return response()->json('Image uploaded successfull');
        }
    }
    public function deleteAccount(Request $request)
    {
        $currentUser = auth()->user();
        $validate = $request->validate([
            "ReceiveValue" => [
                "required",
                "string",
                new passwordValidationRule(
                    $request->input("ReceiveValue"),
                    $currentUser->password
                ),
            ],
        ]);
        if ($validate) {
            return redirect("/");
        }
    }
}
