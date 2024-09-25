<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::latest();
        $users = $users->get();
        return view('admin.users.index' , compact('users'));
    }

    public function create(Request $request){
        return view('admin.users.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'status' => 'required|in:0,1',
        ]);

        if($validator->passes()){
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password =  Hash::make($request->password);
            $user->status = $request->status;
            $user->save();

            session()->flash('success', 'user added successfully');
            return response()->json([
                'status' => true,
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

    }

    public function edit($id){
        $user = User::find($id);

        if (empty($user)){
            session()->flash('error', 'Record not found');
            return redirect()->route('users.index');
        }
        
        return view('admin.users.edit', compact('user'));
    }

    public function update($id,Request $request){
        $user = User::find($id);

        if (empty($user)){
            session()->flash('error', 'Record not found');
            return redirect()->route('users.index');
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:5',
            'status' => 'required|in:0,1',
        ]);

        if($validator->passes()){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

            if($request->password){
                $user->password = Hash::make($request->password);
            }

            $user->status = $request->status;
            $user->save();

            session()->flash('success', 'user updated successfully');
            return response()->json([
                'status' => true,
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function destroy($id){
        $user = User::find($id);

        if (empty($user)) {
            session()->flash('error', 'Record not found');
            return redirect()->route('users.index');
        }

        $user->delete();

        session()->flash('success', 'user deleted successfully');
        
        return response()->json([
            'status' => true,
        ]);
    }
}
