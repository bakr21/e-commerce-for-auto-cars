<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\StoreMessageRequest;
use App\Models\Message;

class ContactController extends Controller
{
        public function index()
    {
        $messages = Message::all();
        return view('admin.messages.index', compact('messages'));
    }

    public function store(StoreMessageRequest $request)
    {

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
