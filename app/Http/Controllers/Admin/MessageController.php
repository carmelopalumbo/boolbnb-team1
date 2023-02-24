<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index()
    {
        sleep(1);
        $query = Property::query()->with('messages');
        $query->where('user_id', Auth::id());
        $properties = $query->get();


        return Inertia::render('Admin/Messages', compact('properties'));
    }

    public function store(Request $request)
    {
        sleep(1);
        //dd($request->all());
        $message = $request->all();
        //dd($message);
        Message::create([
            'email' => $message['message']['email'],
            'content' => $message['message']['content'],
            'property_id' => $message['property']['id']
        ]);

        return to_route('propertydetail', $message['property']['id']);
    }

    public function delete(Request $request)
    {
        $delete_data = $request->all();
        $message = Message::where('id', $delete_data['id'])->first();

        $message->delete();

        return to_route('mymessages');
    }
}
