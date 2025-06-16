<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::latest();
        $users = $users->get();
        return view('admin.users.index' , compact('users'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request){
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
    }

    public function edit($id){
        $user = User::find($id);

        if (empty($user)){
            session()->flash('error', 'Record not found');
            return redirect()->route('users.index');
        }
        
        return view('admin.users.edit', compact('user'));
    }

    public function update($id, UpdateUserRequest $request){
        $user = User::find($id);

        if (empty($user)){
            session()->flash('error', 'Record not found');
            return redirect()->route('users.index');
        }

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
