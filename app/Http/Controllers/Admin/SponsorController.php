<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();
        sleep(1);
        return Inertia::render('Admin/Sponsor', compact('sponsors'));
    }
}
