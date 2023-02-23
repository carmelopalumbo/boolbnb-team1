<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index()
    {
        sleep(1);
        return Inertia::render('Admin/Messages');
    }

    public function store(Request $request, Property $property)
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
}
