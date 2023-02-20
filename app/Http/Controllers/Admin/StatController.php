<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatController extends Controller
{
    public function index()
    {
        sleep(1);
        return Inertia::render('Admin/Stats');
    }
}
