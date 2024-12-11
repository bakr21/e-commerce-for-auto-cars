<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        return view('admin.profile.index', compact('user'));
    }

    public function processChangesProfile(Request $request)
    {
        // التحقق من صحة الإدخالات
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = User::find(Auth::id());
        if ($validator->passes()) {
            
            if (!Hash::check($request->old_password, $user->password)) {
                session()->flash('error', 'Your old password is incorrect, please try again.');
                return response()->json([
                    'status' => true,
                ]);
            }

            User::where('id', $user->id)->update([
                'password' => Hash::make($request->new_password),
            ]);

            session()->flash('success', 'Password has been changed successfully.');

            return response()->json([
                'status' => true,
            ]);

            
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }
}
