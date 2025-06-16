<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{
    public function index(){
        return view('website.account.change-password');
    }

    public function changePassword(ChangePasswordRequest $request){
        $user = User::select('id', 'password')->where('id', Auth::user()->id)->first();

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully.'
        ]);
    }
}
