<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
        public function index()
    {
        $messages = Message::all();
        return view('admin.messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Message::create($request->all());

        return response()->json(['success' => 'Your message has been sent successfully!']);
    
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messages.show', compact('message'));
    }

    public function destroy($id) {
        $messages = Message::find($id);
        $messages->delete();

        if ($messages == null ){
            session()->flash('error', 'Message Not Found');
            return response()->json([
                'status' => true,
            ]);
        }
        
        session()->flash('success', 'Message deleded successfully');
        return response()->json([
            'status' => true,
        ]);
    }
}
