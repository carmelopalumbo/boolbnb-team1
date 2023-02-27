<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SponsorController extends Controller
{
    public function index()
    {
        $properties = Property::where('user_id', Auth::id())->paginate(4);
        $sponsors = Sponsor::all();
        sleep(1);
        return Inertia::render('Admin/Sponsor', compact('sponsors', 'properties'));
    }
}
