<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class GuestController extends Controller
{
    public function index()
    {
        $properties = Property::all();

        return Inertia::render('Guest/Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'properties'=> $properties,
        ]);
    }
}
