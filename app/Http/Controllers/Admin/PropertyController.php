<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $my_properties = Property::where('user_id', Auth::id())->get();
        return Inertia::render('Admin/Index', compact('my_properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Property::create([
            'name' => $request->name,
            'slug' => Property::slugGenerator($request->name),
            'description' => $request->description,
            'cover_image' => 'TEST',
            'beds' => $request->beds,
            'price' => $request->price,
            'address' => $request->address,
            'user_id' => Auth::id(),
            'is_visible' => true,
            'is_sponsored' => false,
            'latitude'=>'not available',
            'longitude'=>'not available'

        ]);


        return to_route('properties.index')->with('message', 'The property has been added correctly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        $properties = Property::where('user_id', Auth::id())->get();
        $properties = $property;
        return Inertia::render('Admin/Show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
